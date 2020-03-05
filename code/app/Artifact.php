<?php

namespace App;

class Artifact
{
    public $id;
    public $title;
    public $attributes;
    public $modifiers;
    public $description;
    public $imageUrl;
    public $price;

    /**
     * Artifact constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = isset($data['id']) ? $data['id'] : '';
        $this->title = $data['title'] ?? '';
        $this->attributes = $data['attributes'] ?? '';
        $this->modifiers = $data['modifiers'] ?? '';
        $this->description = $data['flavour_text'] ?? '';
        $this->imageUrl = $data['image_url'] ?? '';
        $this->price = $data['price'] ?? '';

        return $this;
    }

    /**
     * Render artifact attributes
     *
     * @return string
     */
    public function renderAttributes(): string
    {
        $attHtml = "";
        foreach ($this->attributes as $attribute) {
            $attHtml .= '<div>';
                $attHtml .= '<span class="default">' . $attribute['name'] . ':&nbsp;</span>';
                $attHtml .= '<span class="tc value">' . $attribute['value'] . '</span>';
            $attHtml .= '</div>';
        }

        return $attHtml;
    }
}
