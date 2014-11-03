<?php

namespace Fp\JsFormValidatorBundle\Tests\TestBundles\DefaultTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * This one is for the sf~2.3 version (are enabled by travis using shell script)
 *
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity()
 *
 * @Assert\Callback(
 *     methods={"validateCallback"},
 *     groups={"groups_callback"}
 * )
 * @Assert\Callback(
 *     methods={"ownCallback"},
 *     groups={"groups_callback"}
 * )
 * @Assert\Callback(
 *     methods={{"Fp\JsFormValidatorBundle\Tests\TestBundles\DefaultTestBundle\Validator\ExternalValidator", "validateStaticCallback"}},
 *     groups={"groups_callback"}
 * )
 * @Assert\Callback(
 *     methods={{"Fp\JsFormValidatorBundle\Tests\TestBundles\DefaultTestBundle\Validator\ExternalValidator", "validateDirectStaticCallback"}},
 *     groups={"groups_callback"}
 * )
 */
class CustomizationEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="disabled", type="string", length=255)
     * @Assert\NotBlank(
     *     message="disabled_field_message",
     *     groups={"groups_callback"}
     * )
     */
    private $disabled;

    /**
     * @var string
     *
     * @ORM\Column(name="show_errors", type="string", length=255)
     * @Assert\NotBlank(
     *     message="show_errors_message",
     *     groups={"groups_callback"}
     * )
     */
    private $showErrors;

    /**
     * @var string
     *
     * @ORM\Column(name="callback_groups", type="string", length=255)
     * @Assert\NotBlank(
     *     message="groups_default_message"
     * )
     * @Assert\NotBlank(
     *     message="groups_callback_message",
     *     groups={"groups_callback"}
     * )
     */
    private $callbackGroups;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    public $isValid = false;

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Disabled
     *
     * @return string
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set disabled
     *
     * @param string $disabled
     *
     * @return CustomizationEntity
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get ShowErrors
     *
     * @return string
     */
    public function getShowErrors()
    {
        return $this->showErrors;
    }

    /**
     * Set showErrors
     *
     * @param string $showErrors
     *
     * @return CustomizationEntity
     */
    public function setShowErrors($showErrors)
    {
        $this->showErrors = $showErrors;

        return $this;
    }

    /**
     * Get CallbackGroups
     *
     * @return string
     */
    public function getCallbackGroups()
    {
        return $this->callbackGroups;
    }

    /**
     * Set callbackGroups
     *
     * @param string $callbackGroups
     *
     * @return CustomizationEntity
     */
    public function setCallbackGroups($callbackGroups)
    {
        $this->callbackGroups = $callbackGroups;

        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return 'custom';
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return CustomizationEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool
     *
     * @Assert\True(
     *     message="getter_message",
     *     groups={"groups_callback"}
     * )
     */
    public function isPasswordLegal()
    {
        return false;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function validateCallback(ExecutionContextInterface $context)
    {
        $context->addViolationAt('email', 'validate_callback_email_' . $this->getEmail());
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function ownCallback(ExecutionContextInterface $context)
    {
        $context->addViolationAt('email', 'own_callback_email_' . $this->getEmail());
    }

    /**
     * @return array
     * @Assert\Choice(
     *     callback="getChoicesList",
     *     message="callback_choices_list",
     *     groups={"groups_callback"}
     * )
     */
    public function isValidChoicesList()
    {
        return 'September';
    }

    /**
     * @return array
     */
    public static function getChoicesList()
    {
        return array('June', 'July', 'August');
    }
}
