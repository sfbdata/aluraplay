<?php

namespace aluraplay\Entity;

class Video
{
    public readonly int $id;
    public readonly string $url;
    private ?string $filepath = null;
    public function __construct(
        string $url,
        public readonly string $title
    )
    {
        $this->setUrl($url);
    }
    private function setUrl(string $url): void
    {
        if(filter_var($url, FILTER_VALIDATE_URL) === false){
            throw new \InvalidArgumentException();
        }
        $this->url = $url;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string|null $filepath
     */
    public function setFilepath(?string $filepath): void
    {
        $this->filepath = $filepath;
    }

    /**
     * @return string|null
     */
    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

}