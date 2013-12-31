<?php
namespace HcbTranslations\View\Model\User;

use App\Service\User\RedirectServiceInterface;
use App\View\Model\User\AbstractModel;
use Zend\Http\PhpEnvironment\Request;

class LoginModel extends AbstractModel
{
    /**
     * @param RedirectServiceInterface $redirectService
     */
    public function __construct(RedirectServiceInterface $redirectService)
    {
        $this->setTemplate('backend/user/login');

        parent::__construct($redirectService);
    }
}
