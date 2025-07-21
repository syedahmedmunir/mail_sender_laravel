<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MailSenderRepository.
 *
 * @package namespace App\Repositories;
 */
interface MailSenderRepository extends RepositoryInterface
{
     public function create($data);

}
