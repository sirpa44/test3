<?php  declare(strict_types=1);

namespace App\Service;

use Psr\SimpleCache\CacheInterface;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Translate
{
    /**
     * @var string
     */
    protected $source;
    /**
     * @var GoogleTranslate
     */
    protected $translate;
    /**
     * @var CacheInterface
     */
    protected $cache;

    public function __construct($source, CacheInterface $cache)
    {
        $this->source = $source;
//        $this->translate = $translate;
        $this->cache = $cache;
    }

    /**
     * translate a sentence
     *
     * @param string $sentence
     * @return string
     * @throws \ErrorException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function translateSentence(string $sentence): string
    {
        $this->translate->setSource($this->source);
        $this->translate->setTarget($this->cache->get('lang'));
        $translatedSentence = $this->translate->translate($sentence);
        return $translatedSentence;
    }

}