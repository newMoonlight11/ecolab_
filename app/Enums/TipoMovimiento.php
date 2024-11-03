<?php

namespace App\Enums;

enum TipoMovimiento: string
{
    case COMPRA = 'Compra';
    case PRESTAMO = 'Préstamo';
    case DEVOLUCION = 'Devolución';

    public function getId(): int
    {
        return match ($this) {
            self::COMPRA => 1,
            self::PRESTAMO => 2,
            self::DEVOLUCION => 3,
        };
    }

    public function getName(): string
    {
        return $this->value;
    }

    public static function getAll(): array
    {
        return [
            self::COMPRA->getId() => self::COMPRA->getName(),
            self::PRESTAMO->getId() => self::PRESTAMO->getName(),
            self::DEVOLUCION->getId() => self::DEVOLUCION->getName(),
        ];
    }

    public static function fromId(int $id): ?self
    {
        return match ($id) {
            1 => self::COMPRA,
            2 => self::PRESTAMO,
            3 => self::DEVOLUCION,
            default => null,
        };
    }

    public static function getIds(): array
    {
        return array_map(fn($case) => $case->getId(), self::cases());
    }
}
