<?php
namespace HcbBlog\Data\Posts\Post\Data;

use HcCore\Data\DataMessagesInterface;
use HcBackend\Data\Page;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zf2FileUploader\Input\Image\LoadResourceInterface as LoadResourceInputInterface;

class Save extends Page implements SaveInterface, DataMessagesInterface
{
    /**
     * @var Translator
     */
    protected $translate;

    /**
     * @var array
     */
    protected $clientsEntities = array();

    /**
     * @var LoadResourceInputInterface
     */
    protected $resourceInputPreviewLoader;

    /**
     * @var LoadResourceInputInterface
     */
    protected $resourceInputContentLoader;

    /**
     * @param Request $request
     * @param Extractor $requestExtractor
     * @param Translator $translator
     * @param LoadResourceInputInterface $resourceInputLoader
     * @param Di $di
     */
    public function __construct(Request $request,
                                Extractor $requestExtractor,
                                Translator $translator,
                                LoadResourceInputInterface $resourceInputPreviewLoader,
                                LoadResourceInputInterface $resourceInputContentLoader,
                                Di $di)
    {
        parent::__construct($di);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'title'));
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach($di->get('Zend\Validator\StringLength',
                                array('options'=>array('max'=>500))));

        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        /* @var $input \HcBackend\InputFilter\Input\Locale */
        $input = $di->get('HcBackend\InputFilter\Input\Locale',
                          array('name' => 'lang'))
                    ->setRequired(true);
        $this->add($input);

        $this->resourceInputPreviewLoader = $resourceInputPreviewLoader;
        $resourceInputPreviewLoader->setAllowEmpty(true);
        $this->add($resourceInputPreviewLoader);

        $this->resourceInputContentLoader = $resourceInputContentLoader;
        $resourceInputContentLoader->setAllowEmpty(true);
        $this->add($resourceInputContentLoader);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'preview'))
            ->setRequired(false)
            ->setAllowEmpty(true);
        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'content'))
            ->setRequired(false)
            ->setAllowEmpty(true);
        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'tags[]'))
            ->setRequired(false)
            ->setAllowEmpty(true);
        $this->add($input);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'type'))
                    ->setRequired(true)
                    ->setAllowEmpty(false);

        $input->getValidatorChain()->attach($di->get('Zend\Validator\Digits'));
        $this->add($input);

        $this->translate = $translator;

        $this->setData($requestExtractor->extract($request));
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->getValue('type');
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->getValue('tags[]');
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getValue('content');
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return $this->getValue('preview');
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->getValue('lang');
    }

    /**
     * @return ImageResourceInterface[]
     */
    public function getResources()
    {
        return array_merge($this->resourceInputPreviewLoader->getResources(),
                           $this->resourceInputContentLoader->getResources());
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $invalidInputs = $this->getInvalidInput();

        $messages = array();

        if (array_key_exists('lang', $invalidInputs)) {
            $messages['lang'] = $this->translate->translate('Language must be correct');
        }

        if (array_key_exists('title', $invalidInputs)) {
            $messages['title'] = $this->translate->translate('Incorrect title given');
        }

        return $messages;
    }
}
