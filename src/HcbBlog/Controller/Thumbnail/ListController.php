<?php
namespace HcbBlog\Controller\Thumbnail;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use HcCore\Controller\Common\Collection\AbstractResourceController;
use HcCore\Service\FetchServiceInterface;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\Parameters;
use Zend\View\Model\JsonModel;
use Zf2Libs\Paginator\ViewModel\JsonModelInterface;
use HcbBlog\Service\Posts\Post\FetchQbBuilderService;

class ListController extends AbstractResourceController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var JsonModelInterface
     */
    protected $viewModel;

    /**
     * @var FetchQbBuilderService
     */
    protected $fetchLocale;

    /**
     * @param FetchServiceInterface $fetchService
     * @param JsonModelInterface $viewModel
     * @param EntityManager $entityManager
     */
    public function __construct(FetchServiceInterface $fetchService,
                                EntityManager $entityManager,
                                FetchQbBuilderService $fetchLocale)
    {
        $this->entityManager = $entityManager;
        $this->fetchLocale = $fetchLocale;

        parent::__construct($fetchService);
    }

    /* (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        /* @var $postEntity \HcbBlog\Entity\Post */
        $postEntity = $this->getResourceEntity();

        /* @var $localeCollection \HcbBlog\Entity\Post\Data[] */
        $localeCollection = $this->fetchLocale->fetch($postEntity,
                                                      new Parameters($this->params()->fromQuery()));

        $result = new JsonModel();
        if (is_null($localeCollection->current())) {
            return $e->setResult($result);
        }

        $extractor = new DoctrineObject($this->entityManager, true);

        $postDataEntity = $localeCollection->current();
        /* @var $image \HcbBlog\Entity\Post\Data\Image */
        foreach ($postDataEntity->getDataImage() as $k=>$image) {
            if ($image->getIsPreview() != 1) {
                continue;
            }
            $image = $extractor->extract($image->getImage());
            $image['path'] = $image['httpPath'];
            $image['id'] = $image['token'];
            $result->setVariable(0, $image);
            break;
        }

        $e->setResult($result);
    }
}
