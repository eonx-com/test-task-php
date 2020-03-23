<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Database\Entities\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Controller constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Return error JSON response.
     *
     * @param array|null $data
     * @param int|null $status
     * @param array|null $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(?array $data = null, ?int $status = null, ?array $headers = null): JsonResponse
    {
        return \response()->json($data ?? [], $status ?? 400, $headers ?? []);
    }

    /**
     * Remove entity from database.
     *
     * @param \App\Database\Entities\Entity $entity
     *
     * @return void
     */
    protected function removeEntity(Entity $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    /**
     * Save entity into database.
     *
     * @param \App\Database\Entities\Entity $entity
     *
     * @return void
     */
    protected function saveEntity(Entity $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * Return successful JSON response.
     *
     * @param array|null $data
     * @param array|null $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successfulResponse(?array $data = null, ?array $headers = null): JsonResponse
    {
        return \response()->json($data ?? [], 200, $headers ?? []);
    }
}
