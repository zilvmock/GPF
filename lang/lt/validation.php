<?php

return [

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

    'accepted' => 'Šis laukas turi būti priimtas.',
    'accepted_if' => 'This field must be accepted when :other is :value.',
    'active_url' => 'Šio lauko reikšmė nėra galiojantis internetinis adresas.',
    'after' => 'Šio lauko reikšmė turi būti po :date datos',
    'after_or_equal' => 'Šio lauko reikšmė privalo būti data lygi arba vėlesnė negu :date.',
    'alpha' => 'Šis laukas gali turėti tik raides.',
    'alpha_dash' => 'Šis laukas gali turėti tik raides, skaičius ir brūkšnelius.',
    'alpha_num' => 'Šis laukas gali turėti tik raides ir skaičius.',
    'array' => 'Šis laukas turi būti masyvas.',
    'attached' => 'Šis laukas jau yra pridėtas.',
    'before' => 'Šio lauko reikšmė turi būti data prieš :date.',
    'before_or_equal' => 'Šio lauko reikšmė privalo būti data lygi arba ankstesnė negu :date.',
    'between' => [
        'array' => 'Elementų skaičius šiame lauke turi turėti nuo :min iki :max.',
        'file' => 'Failo dydis šiame lauke turi būti tarp :min ir :max kilobaitų.',
        'numeric' => 'Šio lauko reikšmė turi būti tarp :min ir :max.',
        'string' => 'Simbolių skaičius šiame lauke turi būti tarp :min ir :max.',
    ],
    'boolean' => "Šio lauko reikšmė turi būti 'taip' arba 'ne'.",
    'confirmed' => 'Šio lauko patvirtinimas nesutampa.',
    'date' => 'Šio lauko reikšmė nėra galiojanti data.',
    'date_equals' => 'Šio lauko reikšmė turi būti data lygi :date.',
    'date_format' => 'Šio lauko reikšmė neatitinka formato :format.',
    'declined' => 'This value must be declined.',
    'declined_if' => 'Ši reikšmė turi būti atmesta, kai :other yra :value.',
    'different' => 'Šio lauko reikšmė privalo skirtis nuo :other.',
    'digits' => 'Šio laukas turi būti sudarytas iš :digits skaitmenų.',
    'digits_between' => 'Šis laukas turi turėti nuo :min iki :max skaitmenų.',
    'dimensions' => 'Šis įkeltas paveiksliukas neatitinka išmatavimų reikalavimo.',
    'distinct' => 'Šio lauko reikšmė pasikartoja.',
    'doesnt_end_with' => 'Šis laukas negali baigtis vienu iš šių: :values.',
    'doesnt_start_with' => 'Šis laukas negali prasidėti vienu iš šių: :values.',
    'email' => 'Šio lauko reikšmė turi būti galiojantis el. pašto adresas.',
    'ends_with' => 'Šis laukas turi baigtis vienu iš: :values',
    'enum' => 'Pasirinkta reikšmė yra neteisinga.',
    'exists' => 'Šio lauko reikšmė negalioja.',
    'file' => 'Šis laukas turi būti failas.',
    'filled' => 'Šis laukas turi būti užpildytas.',
    'gt' => [
        'array' => 'Šis laukas turi turėti daugiau nei :value elementus.',
        'file' => 'Šis failas turi būti didesnis negu :value kilobaitai.',
        'numeric' => 'Šio lauko reikšmė turi būti didesnė negu :value.',
        'string' => 'Šio lauko simbolių skaičius turi būti didesnis negu :value simboliai.',
    ],
    'gte' => [
        'array' => 'Šis laukas turi turėti :value elementus arba daugiau.',
        'file' => 'Šis failas turi būti didesnis arba lygus :value kilobaitams.',
        'numeric' => 'Šio lauko reikšmė turi būti didesnė arba lygi :value.',
        'string' => 'Šio lauko reikšmė turi būti didesnė arba lygi :value simboliams.',
    ],
    'image' => 'Šio lauko reikšmė turi būti paveikslėlis.',
    'in' => 'Pasirinkta negaliojanti šio lauko reikšmė.',
    'in_array' => 'Ši reikšmė neegzistuoja :other lauke.',
    'integer' => 'Šio lauko reikšmė turi būti sveikasis skaičius.',
    'ip' => 'Šio lauko reikšmė turi būti galiojantis IP adresas.',
    'ipv4' => 'Šio lauko reikšmė turi būti galiojantis IPv4 adresas.',
    'ipv6' => 'Šio lauko reikšmė turi būti galiojantis IPv6 adresas.',
    'json' => 'Šio lauko reikšmė turi būti JSON tekstas.',
    'lowercase' => 'Šis laukas turi būti mažosiomis raidėmis.',
    'lt' => [
        'array' => 'Šis laukas turi turėti mažiau negu :value elementus.',
        'file' => 'Šis failas turi būti mažesnis negu :value kilobaitai.',
        'numeric' => 'Šio lauko reikšmė turi būti mažesnė negu :value.',
        'string' => 'Šio lauko reikšmė turi būti mažesnė negu :value simboliai.',
    ],
    'lte' => [
        'array' => 'Šis laukas turi turėti mažiau arba lygiai :value elementus.',
        'file' => 'Šis failas turi būti mažesnis arba lygus :value kilobaitams.',
        'numeric' => 'Šio lauko reikšmė turi būti mažesnė arba lygi :value.',
        'string' => 'Šio lauko reikšmė turi būti mažesnė arba lygi :value simboliams.',
    ],
    'mac_address' => 'Reikšmė turi būti galiojantis MAC adresas.',
    'max' => [
        'array' => 'Šis laukas negali turėti daugiau nei :max elementų.',
        'file' => 'Šis failas negali būti didesnis nei :max kilobaitų.',
        'numeric' => 'Šio lauko reikšmė negali būti didesnė nei :max.',
        'string' => 'Šio lauko reikšmė negali būti didesnė nei :max simbolių.',
    ],
    'max_digits' => 'Šis laukas negali turėti daugiau nei :max skaitmenų.',
    'mimes' => 'Šis laukas turi būti failas vieno iš sekančių tipų: :values.',
    'mimetypes' => 'Šis laukas turi būti failas vieno iš sekančių tipų: :values.',
    'min' => [
        'array' => 'Šio lauko elementų kiekis turi būti ne mažiau nei :min.',
        'file' => 'Šis failas turi būti ne mažesnis nei :min kilobaitų.',
        'numeric' => 'Šio lauko reikšmė turi būti ne mažesnė nei :min.',
        'string' => 'Šio lauko simbolių kiekis turi būti ne mažiau nei :min.',
    ],
    'min_digits' => 'Šis laukas turi turėti bent :min skaitmenų.',
    'multiple_of' => 'Šio lauko reikšmė turi būti :value kartotinis.',
    'not_in' => 'Pasirinkta negaliojanti reikšmė.',
    'not_regex' => 'Šio lauko formatas yra neteisingas.',
    'numeric' => 'Šio lauko reikšmė turi būti skaičius.',
    'password' => [
        'letters' => ':attribute turi turėti bent viena raidė.',
        'mixed' => ':attribute turi turėti bent viena didžiosioji ir mažoji raidės.',
        'numbers' => ':attribute turi turėti bent vieną skaičių.',
        'symbols' => ':attribute turi turėti bent vieną simbolį.',
        'uncompromised' => 'Šis :attribute buvo pateiktas duomenų praradimo duomenų bazėje. Prašome pasirinkti kitą :attribute.',
    ],
    'present' => 'Šis laukas turi egzistuoti.',
    'prohibited' => 'Šis laukas yra draudžiamas.',
    'prohibited_if' => 'Šis laukas draudžiamas, kai :other yra :value.',
    'prohibited_unless' => 'Šis laukas yra draudžiamas, nebent :other yra :values.',
    'prohibits' => 'Šis laukas draudžia :other būti pateiktam.',
    'regex' => 'Negaliojantis šio lauko formatas.',
    'relatable' => 'Šis laukas negali būti susijęs su šiuo šaltiniu.',
    'required' => 'Privaloma užpildyti šį lauką.',
    'required_array_keys' => 'Šis laukas turi turėti įrašus: :values.',
    'required_if' => 'Privaloma užpildyti šį lauką, kai :other yra :value.',
    'required_if_accepted' => 'Šis laukas yra privalomas, kai :other yra priimtas.',
    'required_unless' => 'Šis laukas yra privalomas, nebent :other yra tarp :values reikšmių.',
    'required_with' => 'Privaloma užpildyti šį lauką, kai pateikta :values.',
    'required_with_all' => 'Privaloma užpildyti šį lauką, kai pateikta :values.',
    'required_without' => 'Privaloma užpildyti šį lauką, kai nepateikta :values.',
    'required_without_all' => 'Privaloma užpildyti šį lauką, kai nepateikta nei viena iš reikšmių :values.',
    'same' => 'Šis ir :other laukai turi sutapti.',
    'size' => [
        'array' => 'Elementų skačius šiame lauke turi būti :size.',
        'file' => 'Šio failo dydis turi būti :size kilobaitai.',
        'numeric' => 'Šio lauko reikšmė turi būti :size.',
        'string' => 'Simbolių skaičius šiame lauke turi būti :size.',
    ],
    'starts_with' => 'Šis laukas turi prasidėti vienu iš: :values',
    'string' => 'Šis laukas turi būti tekstinis.',
    'timezone' => 'Šio lauko reikšmė turi būti galiojanti laiko zona.',
    'unique' => 'Ši reikšmė jau pasirinkta.',
    'uploaded' => 'Nepavyko įkelti šio lauko.',
    'uppercase' => 'This field must be uppercase.',
    'url' => 'Negaliojantis šio lauko formatas.',
    'uuid' => 'Šio lauko reikšmė turi būti galiojantis UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
