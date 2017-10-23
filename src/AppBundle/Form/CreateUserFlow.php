<?php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateUserFlow extends FormFlow {

    protected $handleFileUploads = false;

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'basic_data',
                'form_type' => 'AppBundle\Form\UserType\StepOne',
            ],
            [
                'label' => 'advanced_data',
                'form_type' => 'AppBundle\Form\UserType\StepTwo',
            ],
            [
                'label' => 'passport_data',
                'form_type' => 'AppBundle\Form\UserType\StepThree',
            ],
        ];
    }
}
