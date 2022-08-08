<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'in_list' => ':attribute غير موجود',
    'accepted' => ':attribute يجب قبول',
    'accepted_if' => ':attribute  يجب قبل  عندما يكون  :other هو :value.',
    'active_url' => ':attribute ليس عنوان URL صالحًا.',
    'after' => ':attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha' => ':attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_spaces' => ':attribute يجب أن تحتوي فقط على أحرف ومسافات.',
    'alpha_num_spaces' => ':attribute يجب أن يحتوي فقط على أحرف وأرقام ومسافات.',
    'alpha_spaces_symbols' => ':attribute يجب أن تحتوي فقط على أحرف ومسافات ورموز.',
    'alpha_num_spaces_symbols' => ':attribute يجب أن تحتوي فقط على أحرف وأرقام ومسافات ورموز.',
    'alpha_dash' => ':attribute يجب أن تحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => ':attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'before' => ':attribute يجب أن يكون تاريخ قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا يسبق أو يساوي :date.',
    'between' => [
        'numeric' => ':attribute يجب ان يكون بين :min و :max.',
        'file' => ':attribute يجب ان يكون بين :min و :max كيلوبايت.',
        'string' => ':attribute يجب ان يكون بين :min و :max احرف.',
        'array' => ':attribute يجب ان يكون بين :min و :max عناصر.',
    ],
    'boolean' => 'حقل :attribute يجب أن يكون صحيحًا أو خطأ.',
    'confirmed' => ':attribute التأكيد غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخ صحيح.',
    'date_equals' => ':attribute يجب أن يكون تاريخًا مساويًا لـ :date.',
    'date_format' => ':attribute لا يتطابق مع الشكل :format.',
    'declined' => ':attribute يجب رفضه.',
    'declined_if' => ':attribute يجب رفضه عندما يكون :other هو :value.',
    'different' => 'يجب أن تكون :attribute و :other مختلفين.',
    'digits' => ':attribute يجب ان يكون :digits أرقام.',
    'digits_between' => ':attribute يجب ان يكون بين  :min و :max أرقام.',
    'dimensions' => ':attribute أبعاد الصورة غير صالحة.',
    'distinct' => 'حقل :attribute له قيمة مكررة.',
    'email' => ':attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => ':attribute يجب أن ينتهي بأحد following: :values.',
    'enum' => 'القيمة المختارة :attribute غير صالح.',
    'exists' => 'القيمة المختارة :attribute غير صالح.',
    'file' => ':attribute يجب أن يكون ملفًا.',
    'filled' => ':attribute يجب أن يكون للحقل قيمة.',
    'gt' => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من :value احرف.',
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عناصر.',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value احرف.',
        'array' => ':attribute يجب ان يكون لديه :value من العناصر أو أكثر.',
    ],
    'image' => ':attribute يجب ان يكون صورة.',
    'in' => 'القيمة المختار :attribute غير موجود.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => ':attribute يجب ان يكون رقم صحيح.',
    'ip' => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'mac_address' => ':attribute يجب أن يكون عنوان MAC صالحًا.',
    'json' => ':attribute يجب أن تكون سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من :value احرف.',
        'array' => ':attribute يجب أن يكون أقل من :value عناصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أصغر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أصغر من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أصغر من أو يساوي :value احرف.',
        'array' => ':attribute يجب ألا يحتوي على أكثر من :value عناصر.',
    ],
    'max' => [
        'numeric' => ':attribute يجب ألا يكون أكبر من :max.',
        'file' => ':attribute يجب ألا يكون أكبر من :max كيلوبايت.',
        'string' => ':attribute يجب ألا يكون أكبر من :max احرف.',
        'array' => ':attribute يجب ألا يحتوي على أكثر من :max عناصر.',
    ],
    'mimes' => ':attribute يجب أن يكون ملف  type: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملف type: :values.',
    'min' => [
        'numeric' => ':attribute لا بد أن يكون على الأقل :min.',
        'file' => ':attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'string' => ':attribute لا بد أن يكون على الأقل :min احرف.',
        'array' => ':attribute يجب أن يكون على الأقل :min عناصر.',
    ],
    'multiple_of' => ':attribute يجب أن يكون من مضاعفات :value.',
    'not_in' => 'القيمة المختار :attribute غير صالحة.',
    'not_regex' => ':attribute التنسيق غير صالح.',
    'numeric' => ':attribute يجب أن يكون رقما.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'حقل :attribute يجب أن يكون موجودًا.',
    'prohibited' => ':attribute المجال محظور.',
    'prohibited_if' => 'حقل :attribute  محظور عندما يكون :other هو :value.',
    'prohibited_unless' => 'حقل :attribute  محظور ما لم يكون :other في :values.',
    'prohibits' => ':attribute يحظر المجال :other من الوجود.',
    'regex' => ':attribute التنسيق غير صالح.',
    'required' => 'حقل :attribute  مطلوب.',
    'required_if' => 'حقل :attribute  مطلوب عندما يكون :other :value.',
    'required_unless' => 'مطلوب حقل :attribute  ما لم يكن :other في :values.',
    'required_with' => 'مطلوب حقل :attribute عند وجود :values.',
    'required_with_all' => 'حقل :attribute مطلوب في حالة وجود :values.',
    'required_without' => 'حقل :attribute مطلوب في حالة عدم وجود :values.',
    'required_without_all' => 'حقل :attribute مطلوب في حالة عدم وجود أي :values.',
    'same' => ':attribute و :other يجب ان تكون متتطابقة.',
    'size' => [
        'numeric' => ':attribute يجب ان يكون :size.',
        'file' => ':attribute يجب ان يكون :size كيلوبايت.',
        'string' => ':attribute يجب ان يكون :size احرف.',
        'array' => ':attribute يجب أن يحتوي على :size عناصر.',
    ],
    'starts_with' => ':attribute يجب أن تبدأ بأحد following: :values.',
    'string' => ':attribute يجب أن يكون نص.',
    'timezone' => ':attribute يجب أن تكون منطقة زمنية صالحة.',
    'unique' => ':attribute محجوز بالفعل.',
    'uploaded' => ':attribute فشل التحميل.',
    'url' => ':attribute يجب أن يكون عنوان URL صالحًا.',
    'uuid' => ':attribute يجب أن يكون UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
