<?php
namespace HcbTranslations\Data\Clients;

use HcbTranslations\Data\DataMessagesInterface;
use HcbTranslations\Service\Clients\Collection\IdsService as ClientsIdsCollection;
use Zend\I18n\Translator\Translator;
use Zend\InputFilter\Input;
use Zend\Validator\Callback as CallbackValidator;
use Zend\Http\PhpEnvironment\Request;
use Zf2Libs\Data\AbstractInputFilter;

class Block extends AbstractInputFilter implements BlockInterface, DataMessagesInterface
{
    /**
     * @var Translator
     */
    protected $translate;

    /**
     * @var array
     */
    protected $clientsEntities = array();

    public function __construct(Request $request,
                                ClientsIdsCollection $clientsIdsCollection,
                                Translator $translator)
    {
        $clientsEntities = &$this->clientsEntities;
        $validateClients = function ($items) use ($clientsIdsCollection, &$clientsEntities){
            $clients = $items;
            if (!is_array($items)) {
                $clients = array((int)$items);
            }
            $clientsEntities = $clientsIdsCollection->fetch($clients);
            return count($clientsEntities) == count($clients);
        };

        $input = new Input('clients');
        $input->setRequired(true);

        $input->getValidatorChain()
              ->attach(new CallbackValidator($validateClients));
        
        $this->add($input);

        $this->translate = $translator;

        $this->setData($request->getPost()->toArray());
    }

    /**
     * @return \App\Entity\User[]
     */
    public function getClients()
    {
        return $this->clientsEntities;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $invalidInputs = $this->getInvalidInput();

        $messages = array();
        if (array_key_exists('clients', $invalidInputs)) {
            $messages['clients'] = $this->translate->translate('Не возможно найти указанных пользователей');
        }

        return $messages;
    }
}
