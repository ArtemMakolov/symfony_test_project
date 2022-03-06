<?php

namespace App\Controller\User;

use App\Dto\Response\ResponseStatusDto;
use App\Entity\User;
use App\Enum\Security\RoleEnum;
use App\Exception\BadRequestException;
use App\Exception\UserFriendlyExceptionInterface;
use App\Helper\ExceptionHelper;
use App\Helper\ResponseHelper;
use App\Transformer\User\UserDtoTransformer;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;
use App\Dto\User\UserDto;

class UserController extends AbstractController
{
    private UserDtoTransformer $userDtoTransformer;
    private LoggerInterface $logger;

    /**
     * UserController constructor.
     * @param UserDtoTransformer $userDtoTransformer
     * @param LoggerInterface $logger
     */
    public function __construct(
        UserDtoTransformer $userDtoTransformer,
        LoggerInterface $logger
    ) {
        $this->userDtoTransformer = $userDtoTransformer;
        $this->logger = $logger;
    }

    /**
     * @Route("/api/users/current", methods={"GET"}, name="users_current")
     * @OA\Response(
     *     response=200,
     *     description="Возвращает текущего пользователя",
     *     @Model(type=UserDto::class)
     * )
     * @OA\Response(
     *     response=401,
     *     ref="#/components/responses/NotAuthorized"
     * )
     * @OA\Response(
     *     response=500,
     *     ref="#/components/responses/UnexpectedError"
     * )
     * @OA\Tag(name="User")
     * @Security(name="bearerAuth")
     *
     * @IsGranted(RoleEnum::ROLE_USER, message="Недостаточно прав для доступа")
     *
     * @param User $user
     * @return Response
     * @throws UserFriendlyExceptionInterface
     */
    public function current(UserInterface $user): Response
    {
        try {
            return $this->json($this->userDtoTransformer->fromUserEntity($user));
        } catch (UserFriendlyExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            $this->logger->error($e);

            return $this->json(ExceptionHelper::createUnhandledExceptionObj(), 500);
        }
    }
}
