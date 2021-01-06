<?php
include_once '../models/PublishersModel.php';

class PublishersController{
    public static function getAllPublishersController(){
        return PublishersModel::getAllPublishersModel('publishers');
    }

    public static function getOnePublisherController($id){
        return PublishersModel::getOnePublisherModel('publishers', $id);
    }

    public static function createPublisherController($title, $country){
        return PublishersModel::createPublisherModel('publishers',$title, $country);
    }

    public static function updatePublisherController($id, $title, $country){
        return PublishersModel::updatePublisherModel('publishers',$id, $title, $country);
    }

    public static function deletePublisherController($id){
        return PublishersModel::deletePublisherModel('publishers', $id);
    }
}