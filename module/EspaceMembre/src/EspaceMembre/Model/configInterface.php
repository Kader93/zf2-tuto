<?php

interface ConfigForm
{
    public function getArrayConfig($strContentsFile);
    public function isValidElement($element);
}

interface ConfigFileForm
{
    public function getContentsfile($file = NULL);
}