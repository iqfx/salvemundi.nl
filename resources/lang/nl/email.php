<?php
    return [
        'confirm_application'    => [
            'subject'      => 'Bevestig je inschrijving',
            'greeting'     => 'Hoi :name,',
            'instructions' => 'Om je inschrijving én email-adres bij Salve Mundi te bevestigen hoef je nu alleen nog maar op de link in dit bericht te klikken.
      Heb je deze email niet aangevraagd? Dan kan je hem gerust negeren.',
            'not_complete' => 'Je inschrijving is echter nog niet compleet. We willen graag dat je nog €25,- overmaakt naar NL97 RABO 0326 3418 11. Benoem hierbij je naam en PCN bij de beschrijving, dat maakt het voor ons overzichtelijker. ',
            'when_done'    => 'Als je dit allemaal hebt gedaan, ontvang je zo snel mogelijk je pasje.',
            'link'         => 'Bevestig je inschrijving',
        ],
        'new_member_application' => [
            'subject'    => 'Nieuwe inschrijving van :name',
            'greeting'   => 'Hallo bestuur,',
            'intro_text' => 'Er is een nieuwe aanmelding voor Salve Mundi ingezonden. De gebruiker heeft betaald voor de inschrijving. Meer informatie over de transactie kan gevonden worden op Mollie.com.',
            'sent_from'  => 'Deze aanmelding is verzonden vanaf :ip.',
        ],
        'signup'                 => [
            'payment_confirmation' => [
                'subject'      => 'Bedankt voor je inschrijving!',
                'greeting'     => 'Hoi :name,',
                'instructions' => 'Goed nieuws! We hebben zojuist je betaling ontvangen en dat betekent dat we automatisch je aanmelding hebben bevestigd. Welkom bij Salve Mundi!',
                'more_info'    => 'Dus ter bevestiging: We hebben zojuist 25 euro van je ontvangen en deze gekoppeld aan je aanmelding. Deze kosten bestaan uit 20 euro voor het lidmaatschap voor 1 jaar en 5 euro voor je ledenpas. Je zal nog van ons horen, maar wees niet bang om vragen te stellen aan ons door te mailen naar info@salvemundi.nl of door ons aan te spreken op school.'
            ],
        ],
        'membership'             => [
            'payment_confirmation' => [
                'subject'            => 'Bedankt voor het verlengen van je lidmaatschap!',
                'greeting'           => 'Hoi :name,',
                'membership_renewed' => 'Fantastisch nieuws! We hebben zojuist je betaling ontvangen en dat betekent dat we automatisch je lidmaatschap hebben verlengd van Salve Mundi.
                We heten je van harte nogmaals een jaar welkom bij Salve Mundi. Je lidmaatschap is geldig tot en met :valid_until. Meer informatie over je lidmaatschappen kan je vinden op onze website.'
            ]
        ],
        'camping'                => [
            'payment_confirmation' => [
                'subject'      => 'Bedankt voor je aanmelding!',
                'greeting'     => 'Hoi :name,',
                'instructions' => 'Goed nieuws! We hebben zojuist je betaling ontvangen en dat betekent dat we automatisch je aanmelding hebben bevestigd. Het lijkt er dus op dat je meegaat op kamp, gezellig!',
                'more_info'    => 'Dus ter bevestiging: We hebben zojuist :amount euro van je ontvangen en deze gekoppeld aan je aanmelding. Je zal nog van ons horen, maar wees niet bang om vragen te stellen aan ons door te mailen naar kamp@salvemundi.nl of door ons aan te spreken op school. Blijf vooral ook de Facebook-pagina van het kamp in de gaten houden voor de laatste updates!'
            ],
            'new_application'      => [
                'subject'    => 'Nieuwe kamp-aanmelding van :name',
                'greeting'   => 'Hallo kampcommissie,',
                'intro_text' => 'Er is een nieuwe aanmelding voor het kamp ingezonden. De gebruiker heeft betaald.',
                'sent_from'  => 'Deze aanmelding is verzonden vanaf :ip.',
            ],
        ],

        'intro' => [
            'confirm_application'      => [
                'subject'      => 'Bevestig je inschrijving voor de intro',
                'greeting'     => 'Geachte :name,',
                 'instructions' => 'Tof dat een plekje hebt gereserveerd voor de introductie van FHICT in :year. Het belooft een fantastische introductie te worden. Tijdens deze introductie zal je kennismaken met je studiegenoten en met het echte studentenleven. Deze introductie is georganiseerd door Salve Mundi, de studievereniging van Fontys Hogescholen ICT.',
                //'instructions' => 'Je hebt je ingeschreven voor de introductie van FHICT :year. Dit vinden wij erg leuk, maar wat wij minder leuk vinden is dat je je e-mailadres nog niet bevestigd hebt. Op deze manier kunnen wij geen betaalverzoek sturen. Wij willen je verzoeken om je e-mailadres te bevestigen zodat we een betaalverzoek kunnen sturen en hopelijk ook jou terug mogen zien bij de introductie van FHICT :year!',
                'link'         => 'Bevestig je inschrijving',
                'when_done'    => 'LET OP: Je inschrijving wordt pas definitief bevestigd wanneer je hebt betaald. Hiervoor is het eerst nodig om nu direct je e-mailadres te bevestigen. Je kan rond juli een e-mail van ons verwachten waarin we je verzoeken om aan de betaling te voldoen. Na deze betaling hoef je geen verdere acties te ondernemen.'
            ],
            'new_application'          => [
                'subject'    => 'Betaald: Nieuwe intro-inschrijving van :name',
                'greeting'   => 'Hallo introcommissie,',
                'intro_text' => 'Er is een nieuwe aanmelding voor de intro ingezonden. De gebruiker heeft betaald. Het bedrag staat hieronder vermeld.',
                'true'       => 'Ja',
                'false'      => 'Nee',
                'sent_from'  => 'Deze aanmelding is verzonden vanaf :ip.',
            ],
            'payment_request'          => [
                'subject'      => 'Verzoek tot betaling intro FHICT',
                'greeting'     => 'Hallo :name!',
                'instructions' => 'Het is bijna zover, de introductie van FHICT :year kan bijna van start gaan!
Je hebt dit mailtje ontvangen omdat je jezelf hebt ingeschreven voor de introductie van :year. Hierbij krijg je dan ook van ons de link om de betaling over te kunnen maken. Wij vragen hiervoor :price euro.',
                'link'         => 'Open de betaling',
                'when_done'    => 'Het is de bedoeling dat dit voor het begin van de maand van de introductie gebeurt. Wij hopen graag iedereen die zich ingeschreven heeft terug te zien bij de introductie van FHICT :year! Wanneer de betaling succesvol is zal je aanmelding definitief bevestigd worden en zullen we je hiervan op de hoogte stellen. Mocht je nog verdere vragen hebben, dan kan je ons altijd <a href="https://wa.me/31636142514" target="_blank">een WhatsApp-berichtje sturen op +31 6 36142514</a>.',
                'signature'    => 'Tot dan!!
                
Met vriendelijke groet,
De feestcommissie van Salve Mundi'
            ],
            'payment_request_reminder' => [
                'subject' => 'Herinnering: Verzoek tot betaling intro FHICT'
            ],
            'payment_confirmation'     => [
                'subject'      => 'Bedankt voor je aanmelding!',
                'greeting'     => 'Hallo :name!',
                'instructions' => 'Je hebt je inschrijving voltooid voor de introductie van FHICT :year (woehoeeeee)! Je hebt je ingeschreven met de volgende gegevens:',
                'more_info'    => 'Wij kijken erg uit om jou te ontmoeten bij de introductie op 26 augustus 2019. Je bent hier welkom om vanaf 10:00 om je spullen in te checken. Wij zorgen voor: je introductieshirt, slaapplek en natuurlijk een geweldige intro vol met leuke evenementen. Binnenkort krijg je hier meer informatie over.',
                'packing_list' => 'Hier alvast een paklijst zodat je goed voorbereid bent!
                <ul><li>Bevestiging van betaling (deze email)</li>
<li>Douchespullen</li>
<li>Festivalschoenen (oud en vies)</li>
<li>Genoeg schone kleding</li>
<li>Goede zin</li>
<li>Handdoek</li>
<li>Identificatiebewijs</li>
<li>Lampje</li>
<li>Pinpas (met genoeg saldo voor 5 dagen feesten)</li>
<li>Slaapzak (of ander beddengoed) Er is alleen een matras en kussen aanwezig, de rest moet zelf meegenomen worden.</li>
<li>Slippers</li>
<li>Warme kleding voor de avond</li>
<li>Zwemkleding</li></ul>
Alle overige informatie is te vinden op:
https://fontys.nl/Goede-Start/Eindhoven-1/Welkom-bij-HBO-ICT.htm. Mocht je nog verdere vragen hebben, dan kan je ons altijd <a href="https://wa.me/31636142514" target="_blank">een WhatsApp-berichtje sturen op +31 6 36142514</a>.',
                'signature'    => 'Tot dan!!
                
Met vriendelijke groet,
De feestcommissie Salve Mundi'
            ],
            'supervisor'               => [
                'confirm_application' => [
                    'subject'      => 'Bevestig je inschrijving als begeleider voor de intro',
                    'greeting'     => 'Geachte :name,',
                    'instructions' => 'Leuk dat je je hebt aangemeld als begeleider voor de intro van :year. Het belooft een fantastische introductie te worden. Het is nodig om je inschrijving nog te bevestigen door te klikken op de link in deze e-mail.',
                    'link'         => 'Bevestig je inschrijving',
                    'when_done'    => 'We zullen nog contact met je opnemen indien je meedoet als begeleider. We kunnen namelijk maar een beperkt aantal intro-ouders mee laten doen met de intro van 2019.'
                ],
                'new_application'     => [
                    'subject'    => 'Introductie papa/mama-inschrijving van :name',
                    'greeting'   => 'Hallo introcommissie,',
                    'intro_text' => 'Er is een nieuwe aanmelding voor de intro als papa of mama ingezonden. De gebruiker heeft zijn/haar email-adres bevestigd.',
                    'true'       => 'Ja',
                    'false'      => 'Nee',
                    'sent_from'  => 'Deze aanmelding is verzonden vanaf :ip.',
                ],
            ]
        ],

        'store' => [
            'order_confirmation' => [
                'subject' => 'Bevestiging van bestelling :invoice',
                'item_name' => 'Product',
                'amount'    => 'Aantal',
                'price'     => 'Prijs',
                'greeting' => 'Hallo :name,',
                'intro_text' => 'Hartelijk bedankt voor het plaatsen van je bestelling bij Salve Mundi. We hebben je bestelling ontvangen en zullen binnenkort contact opnemen over het afronden van je aankopen. Alvast veel plezier toegewenst met je producten!',
            ],
            'new_order' => [
                'subject' => 'Nieuwe bestelling: :invoice',
                'item_name' => 'Product',
                'amount'    => 'Aantal',
                'price'     => 'Prijs',
                'greeting' => 'Hallo mediacommissie,',
                'intro_text' => 'Er is onlangs een bestelling geplaatst door :name (:email).',
                'no_payment_attached' => 'Er is geen betaling gekoppeld aan deze bestelling.',
                'payment_status' => 'Er is een betaling gekoppeld aan deze bestelling. De status hiervan is: :status'
            ]
        ],

        'signature'  => 'Met vriendelijke groet,
    s.v. Salve Mundi
    https://salvemundi.nl',
        'disclaimer' => "Dit bericht is automatisch verzonden. Antwoorden is hierop niet mogelijk.\nSalve Mundi, Rachelsmolen 1, Gebouw R1, 5612MA Eindhoven, KvK nr. 70280606"
    ];