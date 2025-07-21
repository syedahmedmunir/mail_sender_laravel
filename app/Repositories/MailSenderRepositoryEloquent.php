<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MailSenderRepository;
use App\Models\MailSender;
use App\Validators\MailSenderValidator;
use MailSenderHelper;

/**
 * Class MailSenderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailSenderRepositoryEloquent extends BaseRepository implements MailSenderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MailSender::class;
    }

     public function create($data)
    {

        $data['body']       = $data['body']     ?? 'No content provided';
        $data['subject']    = $data['subject']  ?? 'No subject provided';

        if (MailSenderHelper::send($data)) {
            return parent::create($data);
        }

        return false;  
    }
  
    
    public function processFile($file)
    {
        
        $path 			= $file;
		$inputFileType 	= \PhpOffice\PhpSpreadsheet\IOFactory::identify($path);
		$reader 		= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
		$reader->setReadEmptyCells(false); // Skip empty cells
		$spreadsheet 	= $reader->load($path);
		$items 			= $spreadsheet->getActiveSheet()->toArray();
	
		$items = array_filter($items, function ($row) {
			return !empty(array_filter($row));
		});
		

		unset($items[0]);

        foreach($items as $item) {

            $email      = $item[0] ?? null;
            $subject    = $item[1] ?? null;
            $body       = $item[2] ?? null;

            $data = [
                'email'     => $email,
                'subject'   => $subject,
                'body'      => $body,
            ];
           
            $this->create($data);
        }

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
