<?php

namespace App\Controller\RestApi;

use App\Exception\UserFriendlyExceptionInterface;
use App\Helper\ExceptionHelper;
use App\Request\RestApi\SetParamRequest;
use App\Service\RestApi\FindParamService;
use App\Service\RestApi\SetParamService;
use Exception;
use App\Dto\ParamMicroservice\ParamDto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Enum\Security\RoleEnum;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Annotations as OA;
use Symfony\Component\{
    HttpFoundation\Response,
    Security\Core\User\UserInterface,
    Routing\Annotation\Route
};
use Nelmio\ApiDocBundle\Annotation\{
    Model,
    Security
};
use Throwable;

class SetParamController extends AbstractController
{
    private LoggerInterface $logger;
    private SetParamService $setParamService;

    public function __construct(
        LoggerInterface  $logger,
        SetParamService $setParamService
    )
    {
        $this->logger = $logger;
        $this->setParamService = $setParamService;
    }

    /**
     * @Route("/api/rest-api/params", methods={"POST"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Обновляет список настроек для сервиса restApi",
     *     @Model(type=ParamDto::class)
     * )
     * @OA\Response(
     *     response=400,
     *     ref="#/components/responses/BadRequest"
     * )
     * @OA\Response(
     *     response=401,
     *     ref="#/components/responses/NotAuthorized"
     * )
     * @OA\Response(
     *     response=403,
     *     ref="#/components/responses/Forbidden"
     * )
     * @OA\Response(
     *     response=404,
     *     ref="#/components/responses/NotFound"
     * )
     * @OA\Response(
     *     response=500,
     *     ref="#/components/responses/UnexpectedError"
     * )
     * @OA\Tag(name="RestApi")
     * @Security(name="bearerAuth")
     * @IsGranted(RoleEnum::ROLE_USER, message="Недостаточно прав для доступа")
     *
     * @return Response
     * @throws Exception|UserFriendlyExceptionInterface
     */
    public function setParams(SetParamRequest $request): Response
    {
        try {
            return $this->json($this->setParamService->setParams($request));
        } catch (UserFriendlyExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            $this->logger->error($e);

            return $this->json(ExceptionHelper::createUnhandledExceptionObj(), 500);
        }
    }
}
