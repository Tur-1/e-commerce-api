<?php

namespace App\Modules\Admins\Services;

use App\Modules\Admins\Repositories\AdminRepository;
use App\Modules\Admins\Resources\AdminListResource;
use App\Modules\Admins\Resources\AdminShowResource;

class AdminService
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAll()
    {
        return AdminListResource::collection($this->adminRepository->getAll());
    }
    public function getPaginatedList($records = 16)
    {
        return AdminListResource::collection($this->adminRepository->getPaginatedList($records))
            ->response()
            ->getData(true);
    }

    public function create($validatedRequest)
    {
        return $this->adminRepository->createAdmin($validatedRequest);
    }

    public function show($id)
    {
        return AdminShowResource::make($this->adminRepository->getAdmin($id));
    }

    public function update($validatedRequest, $id)
    {
        $admin = $this->adminRepository->updateAdmin($validatedRequest, $id);

        return AdminShowResource::make($admin);
    }

    public function delete($id)
    {
        return $this->adminRepository->deleteAdmin($id);
    }
}
