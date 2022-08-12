<?php

namespace Monaye\NovaTippyField;

use Laravel\Nova\Fields\Field;

class Tippy extends Field
{


    /**
     * Whether to always show the content for the field expanded or not.
     *
     * @var bool
     */
    public $shouldShow = false;


    public $iconPosition = 'left';

    public $placement = 'top';

    public $iconSize = '20px';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->textAlign('center');

    }

    /**
     * Always show the content of textarea fields inside Nova.
     *
     * @return $this
     */
    public function shouldShow()
    {
        $this->shouldShow = true;

        return $this;
    }

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-tippy-field';

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        $this->withMeta([
            'id' => $resource->id . "-" . $attribute,
            'shouldShow' => $this->shouldShow,
            'iconPosition' => $this->iconPosition,
            'iconSize' => $this->iconSize,
            'placement' => $this->placement,
        ]);
    }
    
    public function resolveForDisplay($resource, $attribute = null)
    {
        parent::resolveForDisplay($resource, $attribute);
        if(!isset($this->meta['tipContent'])) {
            $this->tipContent($this->value);
        }
    }

    /**
     * Allows the tootip to be added on a text.
     *
     * @param string  $text
     * @return $this
     */
    public function text($text)
    {
        return $this->withMeta(['text' => $text]);
    }

    /**
     * Allows the tootip to be added on a text.
     *
     * @param string  $text
     * @return $this
     */
    public function iconPath($iconPath)
    {
        return $this->withMeta(['iconPath' => file_get_contents($iconPath)]);
    }

    public function iconUrl(string $iconUrl)
    {
        return $this->withMeta(['iconUrl' => $iconUrl]);
    }

    /**
     * The size of the icon for the tooltip. In pixels or percentages.
     *
     * @param string  $iconSize
     * @return $this
     */
    public function iconSize(string $iconSize)
    {
        return $this->withMeta(['iconSize' => $iconSize]);
    }

    /**
     * Allows the tootip to be added on a text.
     *
     * @param string  $text
     * @return $this
     */
    public function iconPosition($iconPosition)
    {
        $this->iconPosition = $iconPosition;

        return $this;
    }

    public function tipContent($tipContent)
    {
        return $this->withMeta(['tipContent' => $tipContent]);
    }

    public function placement($placement)
    {
        $this->placement = $placement;

        return $this;
    }

    public function tippyOptions($tippyOptions)
    {
        return $this->withMeta(['tippyOptions' => $tippyOptions]);
    }
}
