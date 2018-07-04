<?php

namespace AppBundle\Service;


class CustomUtils
{
    public function errorsToString($errors)
    {
        $stringError = "";
        $arrayErrors = (array) $errors;

        foreach (current($arrayErrors) as $error){
            $stringError .=  $error->getPropertyPath(). " - ".  $error->getMessage();
        }

        return $stringError;
    }
}