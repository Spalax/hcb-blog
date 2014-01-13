<?php
namespace HcbBlog\Data\Posts\Post\Data;

use HcBackend\Data\DataMessagesInterface;
use HcBackend\Data\Page;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use HcBackend\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use Zend\I18n\Translator\Translator;
use Zend\Validator\Callback;
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
    protected $resourceInputLoader;

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
                                LoadResourceInputInterface $resourceInputLoader,
                                Di $di)
    {
        parent::__construct($di);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'title'));
        $input->setRequired(true);
        $input->getValidatorChain()->attach($di->get('Zend\Validator\StringLength',
                                                     array('options'=>array('max'=>500))));
        $input->getFilterChain()->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

        /* @var $input \Zend\InputFilter\Input */
        $input = $di->get('Zend\InputFilter\Input', array('name'=>'lang'));
        $input->setRequired(true);
        $input->getValidatorChain()
              ->attach($di->get('Zend\Validator\StringLength', array('options'=>array('min'=>2, 'max'=>2))))
              ->attach($di->get('Zend\Validator\Regex', array('pattern'=>'/^[a-z]{2}$/')));
        $input->getFilterChain()->attach($di->get('Zend\Filter\StringToLower'))
                                ->attach($di->get('Zend\Filter\StringTrim'));
        $this->add($input);

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

        $this->resourceInputLoader = $resourceInputLoader;
        $resourceInputLoader->setAllowEmpty(true);
        $this->add($resourceInputLoader);

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
        return $this->resourceInputLoader->getResources();
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $invalidInputs = $this->getInvalidInput();

        \Zf2Libs\Debug\Utility::dump($invalidInputs);
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
