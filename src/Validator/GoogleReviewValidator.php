<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Service\GoogleReview\Model\GoogleReview as GoogleReviewModel;

class GoogleReviewValidator extends ConstraintValidator
{
    /**
     * @param GoogleReviewModel $value
     * @param GoogleReview $constraint
     * @return void
     */
    public function validate($value, Constraint $constraint)
    {
        if (null !== $value->getErrorMessage()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ message }}', $value->getErrorMessage())
                ->setParameter('{{ status }}', $value->getStatus())
                ->addViolation();
        }
    }
}
