<?php

    return [
        'memberships' => [
            'transaction'    => 'Betaling',
            'valid_from'     => 'Geldig vanaf',
            'valid_until'    => 'Geldig tot',
            'no_transaction' => 'Geen betaling gevonden'
        ],
        'membership'  => [
            'renew'   => [
                'title'                    => 'Lidmaatschap verlengen',
                'redirecting'              => 'Je wordt zo doorgestuurd...',
                'redirecting_instructions' => 'Je wordt nu naar onze betalingsprovider Mollie doorgestuurd, om de contributie aan ons te betalen. Als je dit hebt gedaan wordt je lidmaatschap automatisch verlengd.',
                'completed'                => 'Je bent weer voor een jaar #LID🔥',
                'email_instructions'       => 'Bedankt voor het verlengen van je lidmaatschap van Salve Mundi! Je betaling wordt momenteel verwerkt in ons systeem, maar zodra deze succesvol is afgerond krijg je van ons een mailtje ter bevestiging met meer informatie. Mocht je de email niet krijgen binnen 2 werkdagen nadat de betaling is afgerond, kijk dan in je map voor ongewenste email of neem contact met ons op.',
                'already_renewed'          => 'Je lidmaatschap is al verlengd! Je bent op dit moment een actief lid van Salve Mundi.'
            ],
            'payment' => [
                'description' => 'Contributie Salve Mundi voor :first_name :last_name',
                'failed'      => 'Er is iets misgegaan tijdens het verwerken van de transactie. De betaling is mogelijk geannuleerd of verlopen. Je lidmaatschap is daarom ook niet automatisch verlengd. Probeer het later nogmaals'
            ]
        ],
        'about_me'    => [
            'title'                            => 'Over mij',
            'greeting'                         => 'Hallo :name!',
            'change_your_info'                 => 'De onderstaande gegevens zijn bekend bij ons. Klopt er iets niet? <a href="mailto:info@salvemundi.nl">Neem dan alsjeblieft contact met ons op</a> zodat we dit kunnen oplossen.',
            'member_id'                        => 'Lidnummer',
            'pcn'                              => 'PCN',
            'last_name'                        => 'Achternaam',
            'first_name'                       => 'Voornaam',
            'address'                          => 'Adres',
            'city'                             => 'Woonplaats',
            'postal'                           => 'Postcode',
            'birthday'                         => 'Geboortedatum',
            'phone'                            => 'Telefoonnummer',
            'email'                            => 'E-mail-adres',
            'fontys_email'                     => 'Fontys-e-mail-adres',
            'fontys_name'                      => 'Fontys-naam',
            'this_should_be_you'               => 'Dit is hoe wij je in ons systeem hebben staan, :name. Lijkt dit niet bepaald (meer) op jou? Laat het ons dan even weten.',
            'not_a_member'                     => 'Volgens ons systeem ben je op het moment niet in het bezit van een actief lidmaatschap. Hierdoor ben je eigenlijk geen lid van de vereniging totdat je weer contributie betaalt voor het huidige schooljaar.',
            'your_previous_membership_expired' => 'Je vorige lidmaatschap is per :date verlopen.',
            'memberships'                      => 'Lidmaatschap',
            'renew_membership'                 => 'Lidmaatschap verlengen',
            'renew_membership_here'            => 'Het is mogelijk om je lidmaatschap direct te verlengen van :from tot :until door aan de contributie van €:amount te voldoen. Door te klikken op de onderstaande knop zal je worden doorgestuurd naar onze betalingspagina om je lidmaatschap automatisch te laten verlengen.',
            'renew_membership_button'          => 'Verleng mijn lidmaatschap',
            'renew_terms'                      => 'Door je lidmaatschap te verlengen ga je akkoord met de <a target="_blank" href="https://drive.google.com/uc?export=open&id=1ZGaXvr1_b0ToqtzQDqTl0YaGmoymvUpp">algemene voorwaarden</a> van Salve Mundi en ons <a href="' . route('privacy') . '" target="_blank">privacybeleid</a>.',
            'payment_redirect'                 => 'Door op \'Verleng mijn lidmaatschap\' te klikken ga je akkoord met de opslag en verwerking van je persoonsgegevens volgens ons <a href="' . route('privacy') . '" target="_blank">privacybeleid</a>, en zal je worden doorgestuurd naar de betalingspagina. Het is hier mogelijk om met iDeal te betalen. Indien je de betaling annuleert zal je lidmaatschap niet worden verlengd. Het is dan mogelijk om het opnieuw te proberen.',
        ]
    ];
