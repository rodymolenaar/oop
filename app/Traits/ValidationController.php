<?php

namespace App\Traits;

use App\Services\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Valitron\Validator;

trait ValidationController
{
    public function validate(Request $request, array $rules = [])
    {
        if ($request->isMethod('GET')) {
            $data = $request->query->all();
        } else {
            $data = $request->request->all();
        }

        $this->validator = new Validator($data);

        $this->validator->rules($rules);
        $this->validator->validate();

        if (count($this->validator->errors()) > 0) {
            app()->resolve('session')->getFlashBag()->add('errors', $this->validator->errors());

            Redirect::back();
            die;
        }

        return $data;
    }
}