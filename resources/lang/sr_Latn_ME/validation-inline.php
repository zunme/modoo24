<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'Ово поље мора бити прихваћено.',
    'accepted_if'          => 'This field must be accepted when :other is :value.',
    'active_url'           => 'Ово је неприхватљива УРЛ адреса.',
    'after'                => 'Мора да је датум после :date.године.',
    'after_or_equal'       => 'То би требао бити датум након или једнак :date.',
    'alpha'                => 'Ово поље може садржавати само слова.',
    'alpha_dash'           => 'Ово поље може садржавати само слова, бројеве, цртице и подвлаке.',
    'alpha_num'            => 'Ово поље може садржавати само слова и бројеве.',
    'array'                => 'Ово поље мора бити низ.',
    'attached'             => 'Ово поље је већ причвршћено.',
    'before'               => 'То би требао бити датум до :date.године.',
    'before_or_equal'      => 'То мора бити датум пре или једнак :date.',
    'between'              => [
        'array'   => 'This content must have between :min and :max items.',
        'file'    => 'This file must be between :min and :max kilobytes.',
        'numeric' => 'This value must be between :min and :max.',
        'string'  => 'This string must be between :min and :max characters.',
    ],
    'boolean'              => 'Ово поље мора бити истинито или лажно.',
    'confirmed'            => 'Потврда није иста.',
    'current_password'     => 'The password is incorrect.',
    'date'                 => 'То није валидан Датум.',
    'date_equals'          => 'То би требао бити датум једнак :date.',
    'date_format'          => 'То не одговара формату :format.',
    'different'            => 'Ова вредност треба да се разликује од :other.',
    'digits'               => 'То би требало бити :digits цифре.',
    'digits_between'       => 'То би требало бити између :min и :max цифара.',
    'dimensions'           => 'Ова слика има неприхватљиве димензије.',
    'distinct'             => 'Ово поље има понављајућу вредност.',
    'email'                => 'То мора бити валидна адреса е-поште.',
    'ends_with'            => 'Требало би да се заврши са једним од следећих: :values.',
    'exists'               => 'Изабрана вредност је неприхватљива.',
    'file'                 => 'Садржај мора бити датотека.',
    'filled'               => 'Ово поље би требало да направи разлику.',
    'gt'                   => [
        'array'   => 'The content must have more than :value items.',
        'file'    => 'The file size must be greater than :value kilobytes.',
        'numeric' => 'The value must be greater than :value.',
        'string'  => 'The string must be greater than :value characters.',
    ],
    'gte'                  => [
        'array'   => 'The content must have :value items or more.',
        'file'    => 'The file size must be greater than or equal :value kilobytes.',
        'numeric' => 'The value must be greater than or equal :value.',
        'string'  => 'The string must be greater than or equal :value characters.',
    ],
    'image'                => 'То мора бити слика.',
    'in'                   => 'Изабрана вредност је неприхватљива.',
    'in_array'             => ':other.године ово значење није постојало.',
    'integer'              => 'То мора бити цео број.',
    'ip'                   => 'То мора бити валидна ИП адреса.',
    'ipv4'                 => 'То мора бити валидна ИПв4 адреса.',
    'ipv6'                 => 'То мора бити валидна ИПв6 адреса.',
    'json'                 => 'То би требао бити дозвољени ЈСОН низ.',
    'lt'                   => [
        'array'   => 'The content must have less than :value items.',
        'file'    => 'The file size must be less than :value kilobytes.',
        'numeric' => 'The value must be less than :value.',
        'string'  => 'The string must be less than :value characters.',
    ],
    'lte'                  => [
        'array'   => 'The content must not have more than :value items.',
        'file'    => 'The file size must be less than or equal :value kilobytes.',
        'numeric' => 'The value must be less than or equal :value.',
        'string'  => 'The string must be less than or equal :value characters.',
    ],
    'max'                  => [
        'array'   => 'The content may not have more than :max items.',
        'file'    => 'The file size may not be greater than :max kilobytes.',
        'numeric' => 'The value may not be greater than :max.',
        'string'  => 'The string may not be greater than :max characters.',
    ],
    'mimes'                => 'Ово би требало да буде датотека типа: :values.',
    'mimetypes'            => 'Ово би требало да буде датотека типа: :values.',
    'min'                  => [
        'array'   => 'The value must have at least :min items.',
        'file'    => 'The file size must be at least :min kilobytes.',
        'numeric' => 'The value must be at least :min.',
        'string'  => 'The string must be at least :min characters.',
    ],
    'multiple_of'          => 'Ова вредност мора бити вишеструка од :value',
    'not_in'               => 'Изабрана вредност је неприхватљива.',
    'not_regex'            => 'Овај формат је неприхватљив.',
    'numeric'              => 'То мора бити број.',
    'password'             => 'Lozinka je pogrešna.',
    'present'              => 'Ово поље мора бити присутно.',
    'prohibited'           => 'Ово поље је забрањено.',
    'prohibited_if'        => 'Ово поље је забрањено када је :other :value.',
    'prohibited_unless'    => 'Ово поље је забрањено, осим ако је :other у :values.',
    'prohibits'            => 'This field prohibits :other from being present.',
    'regex'                => 'Овај формат је неприхватљив.',
    'relatable'            => 'Ово поље можда није повезано са датим ресурсом.',
    'required'             => 'Ово поље је обавезно.',
    'required_if'          => 'Ово поље је обавезно ако је :other :value.',
    'required_unless'      => 'Ово поље је обавезно ако само :other није у :values.',
    'required_with'        => 'Ово поље је обавезно када је на располагању :values.',
    'required_with_all'    => 'Ово поље је обавезно у присуству :values.',
    'required_without'     => 'Ово поље је обавезно када нема :values.',
    'required_without_all' => 'Ово поље је обавезно ако ниједан од :values није присутан.',
    'same'                 => 'Вредност овог поља треба да одговара вредности од :other.',
    'size'                 => [
        'array'   => 'The content must contain :size items.',
        'file'    => 'The file size must be :size kilobytes.',
        'numeric' => 'The value must be :size.',
        'string'  => 'The string must be :size characters.',
    ],
    'starts_with'          => 'Ово би требало почети са једном од следећих ставки: :values.',
    'string'               => 'То мора да је жица.',
    'timezone'             => 'То мора бити дозвољена зона.',
    'unique'               => 'То је већ учињено.',
    'uploaded'             => 'Ово није успело да се учита.',
    'url'                  => 'Овај формат је неприхватљив.',
    'uuid'                 => 'То мора бити валидан УУИД.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
];
