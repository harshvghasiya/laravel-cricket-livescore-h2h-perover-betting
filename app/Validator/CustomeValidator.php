<?php
namespace App\Validator;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class CustomeValidator extends Validator
{
	
	

	/**
	 * [validatecheckEmailExitAdminUser To check user email exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckCurrencyCodeExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Currency::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("code", $value)
                ->count();

        } else {

            $count = \App\Models\Currency::where("code", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}


	/**
	 * [validatecheckEmailExitAdminUser To check user email exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckEmailExitAdminUser($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

            $count = \App\Models\User::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("email", $value)
                ->count();

        } else {

            $count = \App\Models\User::where("email", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	public function validatecheckNameExitFrontUser($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

            $count = \App\Models\FrontUser::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\FrontUser::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	/**
	 * [validatecheckRightExist To check right name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckRightExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Right::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\Right::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}
	/**
	 * [validatecheckRightExist To check right name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckPinCodeExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\City::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("pin_code", $value)
                ->count();

        } else {

            $count = \App\Models\City::where("pin_code", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	/**
	 * [validatecheckCurrentPassword To check right name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckCurrentPassword($attribute, $value, $parameters)
	{	
		$current_password=\App\Models\User::select('password','id')->where('id',\Auth::user()->id)->first();
        if (\Hash::check($value,$current_password->password)) {
        	$count=0;
        }else{
        	$count=1;
        }
		

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	public function validatecheckFrontCurrentPassword($attribute, $value, $parameters)
	{	
		$current_password=\App\Models\FrontUser::select('password','id')->where('id',\Auth::guard('front_user')->user()->id)->first();
        if (\Hash::check($value,$current_password->password)) {
        	$count=0;
        }else{
        	$count=1;
        }
		

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	/**
	 * [validatecheckCountryExist To check Country name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckCountryExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Country::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("code", $value)
                ->count();

        } else {

            $count = \App\Models\Country::where("code", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	public function validatecheckPromoCodeExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\PromoCode::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\PromoCode::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	public function validatecheckFrontPromoCodeExist($attribute, $value, $parameters)
	{
		 $count = \App\Models\PromoCode::where("name", $value)->where('status',1)->count();
        

        if ($count === 0) {

            return false;

        } else {

            return true;
        }
	}

	/**
	 * [validatecheckFullNameExist To check Contact name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckFullNameExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Contact::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("full_name", $value)
                ->count();

        } else {

            $count = \App\Models\Contact::where("full_name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}
	/**
	 * [validatecheckActivityNameExist To check activity name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckActivityNameExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Activity::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\Activity::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}
	/**
		 * [validatecheckLocationNameExist To check activity name exist or not]
		 * @param  [type] $attribute  [description]
		 * @param  [type] $value      [description]
		 * @param  [type] $parameters [description]
		 * @return [type]             [description]
		 */
		public function validatecheckLocationNameExist($attribute, $value, $parameters)
		{	

			if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

	            $count = \App\Models\Location::where("id", "!=", \Crypt::decrypt($parameters[0]))
	                ->where("name", $value)
	                ->count();

	        } else {

	            $count = \App\Models\Location::where("name", $value)->count();
	        }

	        if ($count === 0) {

	            return true;

	        } else {

	            return false;
	        }
		}

	/**
	 * [validatecheckStateExist To check State name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckStateExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\State::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("code", $value)
                ->count();

        } else {

            $count = \App\Models\State::where("code", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	/**
	 * [validatecheckActivitySubjectTitleExist To check right title exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckActivitySubjectTitleExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\ActivitySubject::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("title", $value)
                ->count();

        } else {

            $count = \App\Models\ActivitySubject::where("title", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}
		/**
			 * [validatecheckCategoryExist To check right name exist or not]
			 * @param  [type] $attribute  [description]
			 * @param  [type] $value      [description]
			 * @param  [type] $parameters [description]
			 * @return [type]             [description]
			 */
			public function validatecheckCategoryExist($attribute, $value, $parameters)
			{	

				if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

		            $count = \App\Models\CompanyCategory::where("id", "!=", \Crypt::decrypt($parameters[0]))
		                ->where("name", $value)
		                ->count();

		        } else {

		            $count = \App\Models\CompanyCategory::where("name", $value)->count();
		        }

		        if ($count === 0) {

		            return true;

		        } else {

		            return false;
		        }
			}

	/**
	 * [validatecheckModuleExist To check right name exist or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckModuleExist($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0]) && $parameters[0] !=null) {

            $count = \App\Models\Module::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\Module::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}



	/**
	 * [validatecheckAclNameExit To check acm module name exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckAclNameExit($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

            $count = \App\Models\Acl::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("title", $value)
                ->count();

        } else {

            $count = \App\Models\Acl::where("title", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}	

	
	
}
?>