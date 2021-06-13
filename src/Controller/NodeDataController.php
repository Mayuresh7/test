<?php
/**
 * @file
 * Contains \Drupal\test\Controller\NodeDataController.
 */
namespace Drupal\test\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class NodeDataController{
    /**
     * @param $site_api_key - the API key parameter
     * @param NodeInterface $node - the node built from the node id parameter
     * @return JsonResponse
     */
    public function jsonResponseData($site_api_key, NodeInterface $node){

        // Get Site API Key.
        $siteapikey = \Drupal::state()->get('siteapikey');

        // Make sure the supplied node is a page, the configuration key is set and matches the supplied key
        if($node->getType() == 'page' && $siteapikey != 'No API Key yet' && $siteapikey == $site_api_key){

            // Respond with the json representation of the node
            return new JsonResponse($node->toArray());
        }

        // Respond with access denied
        return new JsonResponse(array("error" => "access denied"));
    }
}