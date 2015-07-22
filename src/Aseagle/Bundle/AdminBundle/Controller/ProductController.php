<?php

/**
 * This file is part of the Aseagle package.
 *
 * (c) Quang Tran <quang.tran@aseagle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aseagle\Bundle\AdminBundle\Controller;

use Aseagle\Bundle\AdminBundle\Form\Type\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use Aseagle\Bundle\CoreBundle\Helper\Html;
use Doctrine\ORM\EntityRepository;
use Aseagle\Bundle\ContentBundle\Entity\Category;
use Aseagle\Bundle\AdminBundle\Form\Type\ProductType;
use Aseagle\Bundle\EcommerceBundle\Entity\Image;
use Aseagle\Bundle\AdminBundle\Form\Filter\ProductReviewFilter;

/**
 * ProductController
 *
 * @author Quang Tran <quang.tran@aseagle.com>
 */
class ProductController extends BaseController {

    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::indexAction()
     */
    public function indexAction() {
        return parent::indexAction();
    }
    
    /* (non-PHPdoc)
     * @see \Aseagle\Bundle\AdminBundle\Controller\BaseController::grid()
     */
    protected function grid($entities) {
        $grid = array ();
        foreach ($entities as $item) {
            $grid [] = array (
                '<input type="checkbox" name="ids[]" class="check" value="' . $item->getId() . '"/>',
                '<a href="' . $this->generateUrl('admin_product_new', array (
                    'id' => $item->getId()
                )) . '">' . $item->getName() . '</a>',
                $item->getPrice(),
                $item->getQuantity(),
                is_object($item->getCreated()) ? $item->getCreated()->format('d/m/Y') : '',
                Html::showStatusInTable($this->container, $item->getEnabled()),
                Html::showActionButtonsInTable($this->container, array (
                    'edit' => $this->generateUrl('admin_product_new', array (
                        'id' => $item->getId()
                    ))
                ))
            );
        }
        
        return $grid;
    }
    

    /**
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction() {
        $manager = $this->getRequest()->get('_manager');
        if (NULL == $manager) {
            throw $this->createNotFoundException('Missing manager argument');
        }
    
        $form = $this->getRequest()->get('_form');
        if (NULL == $form) {
            throw $this->createNotFoundException('Missing form argument');
        }
    
        $template = $this->getRequest()->get('_view');
        if (NULL == $template) {
            throw $this->createNotFoundException('Missing view argument');
        }
    
        $class = $this->getRequest()->get('_class');
        if (NULL == $form) {
            throw $this->createNotFoundException('Missing form argument');
        }
    
        $oid = $this->getRequest()->get('id', NULL);
        if (NULL !== $oid) {
            if (!$this->get('user_acl')->isAllow('EDIT', $class)) {
                throw $this->createAccessDeniedException('Permission Denied', 403);
            }
            $entity = $this->get($manager)->getObject($oid);
        } else {
            if (!$this->get('user_acl')->isAllow('CREATE', $class)) {
                throw $this->createAccessDeniedException('Permission Denied', 403);
            }
            $entity = $this->get($manager)->createObject();
        }
    
        $form = $this->createForm(new $form($this->container), $entity);
    
        if ('POST' === $this->getRequest()->getMethod()) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                /* Save object */
                $this->get($manager)->save($entity);
    
                if (NULL == $oid) {
                    /* If a new object */
                    $msg = $this->container->get('translator')->trans('Created successful');
                    $this->get('session')->getFlashBag()->add('success', $msg);
    
                    $currentRoute = $this->getRequest()->get('_route');
    
                    if ($this->getRequest()->get('saveedit')) {
                        return $this->redirect($this->generateUrl($currentRoute, array (
                            'id' => $entity->getId()
                        )));
                    }
    
                    return $this->redirect($this->generateUrl($currentRoute));
                }
                $msg = $this->container->get('translator')->trans('Updated successful');
                $this->get('session')->getFlashBag()->add('success', $msg);
            } else {
                $msg = $this->container->get('translator')->trans('Error has occurred while saving object');
                $this->get('session')->getFlashBag()->add('error', $msg);
            }
        }
    
        $formReview = $this->createForm(new ProductReviewFilter());
        
        return $this->render($template, array (
            'form' => $form->createView(),
            'formReview' => $formReview->createView()
        ));
    }

    /**
     * uploadAction
     */
    public function uploadAction() {
        
       /*  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); */
            
        // 5 minutes execution time
        @set_time_limit(5 * 60);
        
        // Uncomment this one to fake upload time
        // usleep(5000);
        
        // Settings
        //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        $targetDir = 'uploads/tmp';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds
                                
        // Create target dir
        if (! file_exists($targetDir)) {
            @mkdir($targetDir);
        }
        
        // Get a file name
        if (isset($_REQUEST ["name"])) {
            $fileName = $_REQUEST ["name"];
        } elseif (! empty($_FILES)) {
            $fileName = $_FILES ["file"] ["name"];
        } else {
            $fileName = uniqid("file_");
        }
        
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        
        // Chunking might be enabled
        $chunk = isset($_REQUEST ["chunk"]) ? intval($_REQUEST ["chunk"]) : 0;
        $chunks = isset($_REQUEST ["chunks"]) ? intval($_REQUEST ["chunks"]) : 0;
        
        // Remove old temp files
        if ($cleanupTargetDir) {
            if (! is_dir($targetDir) || ! $dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
            
            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }
                
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }
        
        // Open temp file
        if (! $out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }
        
        if (! empty($_FILES)) {
            if ($_FILES ["file"] ["error"] || ! is_uploaded_file($_FILES ["file"] ["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }
            
            // Read binary input stream and append it to temp file
            if (! $in = @fopen($_FILES ["file"] ["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (! $in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }
        
        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }
        
        @fclose($out);
        @fclose($in);
        
        // Check if file has been uploaded
        if (! $chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            
            $image = new Image();

            $imageDir = $this->get('kernel')->getRootDir() . '/../web/uploads/products/';
            $imgName = time() . '_' . $fileName;
            
            if (!is_dir($imageDir)) mkdir($imageDir);
            copy($filePath, $imageDir . $imgName);
            $image->setName($imgName);
            $image->setPath($imgName);
            
            @unlink($filePath);
            
            $response = new \stdClass();
            $response->jsonrpc = "2.0";
            $response->result = "OK";
            $response->id = time();
            $response->src = '/uploads/products/' . $image->getPath();
            $response->name = $image->getName();
            $response->path = $imgName;
            
            // Return Success JSON-RPC response
            die(json_encode($response));
        }
        
        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : "OK", "id" : "id"}');
    }

    /**
     * deleteImageAction
     */
    public function deleteImageAction() {
        $request = $this->getRequest();
        
        if($request->getMethod() == 'POST' && $request->isXmlHttpRequest()) {
            $id = $request->get('id');
            $image = $this->get('product_image_manager')->getObject($id);
            if ($image instanceof \Aseagle\Bundle\EcommerceBundle\Entity\Image) {                
                $this->get('product_image_manager')->delete($image);
                return new Response(json_encode(array('status' => 'OK')));
            }
        }
        
        return new Response(json_encode(array('status' => 'KO')));
    }
}
