<?php
namespace Ohio\Content\Behaviors;

interface IncludesTemplateInterface
{

    public function setTemplateAttribute($value);

    public function getTemplateViewAttribute();

}