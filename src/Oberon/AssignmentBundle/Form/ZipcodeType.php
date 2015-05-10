<?php

namespace Oberon\AssignmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;

class ZipcodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zipcode', 'text', 
          array('label' => 'Postcode', 
                'constraints' => array(
                                        new Regex(array('pattern' => '/^[0-9]{4}\s?[a-z]{0,2}$/i'))
                                      )
                )
          );
    }

    public function getName()
    {
        return 'zipcode';
    }
}
