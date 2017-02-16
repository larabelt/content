<?php
namespace Belt\Content\Behaviors;

interface IncludesTemplateInterface
{

    public function setTemplateAttribute($value);

    public function getTemplateViewAttribute();

}