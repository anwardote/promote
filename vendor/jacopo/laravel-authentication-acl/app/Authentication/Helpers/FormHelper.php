<?php

namespace LaravelAcl\Authentication\Helpers;

/**
 * Class FormHelper
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
use LaravelAcl\Authentication\Repository\EloquentPermissionRepository as PermissionRepository;
use LaravelAcl\Authentication\Repository\SentryGroupRepository;
use App\Repositories\RechargeTypeRepository;
use LaravelAcl\Authentication\Repository\SentryUserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\VariableRepository;
use App\Repositories\CmsCategoryRepository;


class FormHelper {

    /**
     * @var \LaravelAcl\Authentication\Repository\EloquentPermissionRepository
     */
    protected $repository_permission;

    /**
     * @var \LaravelAcl\Authentication\Repository\SentryGroupRepository
     */
    protected $repository_groups;
    protected $repository_rechargetype;
    protected $repository_userinfo;
    protected $repository_countries;
    protected $repository_cmsCategory;

    public function __construct(PermissionRepository $rp = null, SentryGroupRepository $rg = null, RechargeTypeRepository $rt = null, SentryUserRepository $ui = null, VariableRepository $vr = null, CountryRepository $cr = null,  CmsCategoryRepository $cmsCategory = null) {
        $this->repository_permission = $rp ? $rp : new PermissionRepository();
        $this->repository_groups = $rg ? $rg : new SentryGroupRepository();
        $this->repository_rechargetype = $rt ? $rt : new RechargeTypeRepository();
        $this->repository_userinfo = $ui ? $ui : new SentryUserRepository();
        $this->repository_countries = $cr ? $cr : new CountryRepository();
        $this->repository_variable = $vr ? $vr : new VariableRepository();
        $this->repository_cmsCategory = $cmsCategory ? $cmsCategory : new CmsCategoryRepository();
    }

    public function getSelectValues($repo_name, $key_value, $value_value) {
        $all_objects = $this->{$repo_name}->all();

        if ($all_objects->isEmpty())
            return [];

        foreach ($all_objects as $object)
            $array_values[$object->{$key_value}] = $object->{$value_value};

        return $array_values;
    }

    public function getSelectValuesPermission() {
        return $this->getSelectValues("repository_permission", 'permission', 'description');
    }

    public function getSelectValuesGroups() {
        return $this->getSelectValues("repository_groups", 'id', 'name');
    }

    /**
     * Prepares permission for sentry given the input
     *
     * @param array $input
     * @param       $operation
     * @param       $field_name
     * @return void
     */
    public function prepareSentryPermissionInput(array &$input, $operation, $field_name = "permissions") {
        $input[$field_name] = isset($input[$field_name]) ? [$input[$field_name] => $operation] : '';
    }

    public function getSelectRechargeTypeOutputValues() {
        return $this->getSelectValues("repository_rechargetype", 'id', 'type_name');
    }

    public function getSelectUserInfoOutputValues() {
        return $this->getSelectValues("repository_userinfo", 'id', 'email');
    }


    public function getSelectCountryOutputValues() {
        return $this->getSelectValues("repository_countries", 'id', 'country_name');
    }



    public function getSelectstatusOutputValues() {
        return $this->getSelectStatusValues();
    }

    public function getSelectStatusValues() {
        $status_output_array = array("approved" => "Approved", "pending" => "Pending", "cancel" => "Cancel", "invalid" => "Invalid");
        foreach ($status_output_array as $key => $val)
            $array_values[$key] = $val;

        return $array_values;
    }

    public function getSelectCmsCategoryOutputValues() {
        return $this->getSelectValues("repository_cmsCategory", 'id', 'name');
    }

    public function getVariablesOutputValues() {
        return $this->getSelectValues("repository_variable", 'id', 'variables');
    }

}
