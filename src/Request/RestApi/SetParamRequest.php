<?php

declare(strict_types=1);

namespace App\Request\RestApi;

use App\Request\RequestDtoInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class SetParamRequest implements RequestDtoInterface
{
    public const ATTR_NAME = 'name';
    public const ATTR_TYPE= 'type';

    /**
     * @var string|null
     * @Assert\NotBlank(message="Название не должно быть пустым")
     * @Assert\All(
     *     @Assert\Length(min=2, minMessage="В названии должно быть больше двух символов")
     * )
     */
    private ?string $name;

    /**
     * @var bool|null
     * @Assert\NotBlank(message="Тип не должен быть пустым")
     */
    private ?bool $type;

    public function __construct(Request $request)
    {
        $requestArr = $request->getContent() ? $request->toArray() : [];

        $this->name = $requestArr[self::ATTR_NAME] ?? null;
        $this->type = $requestArr[self::ATTR_TYPE] ?? null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }
}
