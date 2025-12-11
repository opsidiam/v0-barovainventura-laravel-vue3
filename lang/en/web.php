<?php

return [
    'newsletter' => [
        'title'             => 'Subscribe',
        'subtitle'          => 'Be among the first to get the latest articles straight to your inbox',
        'email_placeholder' => 'Enter your email',
        'submit'            => 'SUBMIT',
    ],

    'download' => [
        'title' => 'Everything you need for the Bar Inventory system in one place',
        'breadcrumbs' => [
            'home'  => 'Home',
            'title' => 'Downloads',
        ],

        // cards on the Downloads page
        'cards' => [
            'pc_win' => [
                'title'    => 'PC App',
                'subtitle' => '(Windows)',
                'desc'     => 'Desktop application for performing inventory. It is used exclusively to conduct inventory together with a scale and a scanner. For overview and closing of the inventory, use the web administration.',
                'cta'      => 'Download',
                // optional: direct URL, if you have it
                // 'url'   => route('register'),
            ],
            'manual_pdf' => [
                'title'    => 'User Manual',
                'subtitle' => '(PDF)',
                'desc'     => 'Manual for using the application and the scale — all essential information in one PDF.',
                'cta'      => 'Download',
            ],
            'pc_mac' => [
                'title'    => 'PC App',
                'subtitle' => '(macOS)',
                'desc'     => 'Desktop application for performing inventory. It is used exclusively to conduct inventory together with a scale and a scanner. For overview and closing of the inventory, use the web administration.',
                'note'     => 'We’re actively working on it',
            ],
            'mobile_android' => [
                'title'    => 'Mobile App',
                'subtitle' => '(Android)',
                'desc'     => 'A helpful companion if you keep stock outside the bar. The app lets you scan and enter the number of full bottles and itemized products in storage. Use the web administration for overviews and closing the inventory; use the PC app for the inventory process.',
                'note'     => 'We’re actively working on it',
            ],
            'mobile_ios' => [
                'title'    => 'Mobile App',
                'subtitle' => '(iOS)',
                'desc'     => 'A helpful companion if you keep stock outside the bar. The app lets you scan and enter the number of full bottles and itemized products in storage. Use the web administration for overviews and closing the inventory; use the PC app for the inventory process.',
                'note'     => 'We’re actively working on it',
            ],
        ],
    ],

    'support' => [
        'title' => 'Contact Support',
        'text'  => 'Fill out the form below and briefly describe your issue. We’ll get back to you as soon as possible. For urgent matters, email info@barovainventura.sk.',
        'breadcrumbs' => [
            'title' => 'Contact Support',
            'home'  => 'Home',
        ],
    ],

    'pricelist' => [
        'title' => 'Our Pricing & Plans',
        'breadcrumbs' => [
            'home'      => 'Home',
            'pricelist' => 'Our Pricing & Plans',
        ],
        'section' => [
            'title'  => 'Simple and fair <span>pricing</span>',
            'toggle' => [
                'month' => 'Monthly',
                'year'  => 'Yearly',
                'offer' => '-10 %',
            ],
        ],

        'plans' => [
            'monthly' => [
                'name'    => '30 days',
                'tagline' => 'Get started',
            ],
            'yearly' => [
                'name'    => '360 days',
                'tagline' => 'Best value',
            ],
        ],

        'features' => [
            'duration'    => 'Duration',
            'locations'   => 'Number of outlets',
            'access'      => 'Access',
            'email_notif' => 'Email notifications',
            'pdf_export'  => 'PDF export',
            'access_full' => 'Full',
            'yes'         => 'Yes',
        ],

        'cta'        => 'Order',
        'note'       => 'Prices are per outlet.',
        'per_outlet' => '/outlet',

        'faq' => [
            'items' => [
                [
                    'q' => 'How much does Bar Inventory cost?',
                    'a' => 'The standard price is <strong>:price € per month per outlet</strong>.',
                ],
                [
                    'q' => 'How is the price calculated?',
                    'a' => 'The price depends <strong>only on the number of outlets</strong> in your account.',
                ],
                [
                    'q' => 'Do you offer a trial period?',
                    'a' => 'Yes, you can try the system for free during the trial period.',
                ],
                [
                    'q' => 'What are the payment and invoicing options?',
                    'a' => 'Payment is made <strong>by invoice</strong>. After placing the order, you’ll be redirected to the <strong>company payment gateway</strong>, where you’ll find a <strong>QR code for payment</strong> and an option to <strong>download the invoice</strong>. You’ll receive the invoice by email <strong>both before and after payment</strong>.',
                ],
                [
                    'q' => 'Do you offer discounts for multiple outlets?',
                    'a' => 'Yes. If you have <strong>more than one outlet</strong>, you automatically get a <strong>5% discount</strong> on the license order.',
                ],
                [
                    'q' => 'Is hardware (scale, scanner) included in the price?',
                    'a' => 'Hardware is <strong>separate</strong> and can be <strong>purchased directly in the app</strong>.',
                ],
                [
                    'q' => 'Is there any contract or minimum term?',
                    'a' => 'No. There is <strong>no lock-in</strong> and no obligation to use the system. <strong>Licenses don’t renew automatically</strong>, and you can stop anytime.',
                ],
                [
                    'q' => 'What about VAT and invoice details?',
                    'a' => 'The company is currently a <strong>non-VAT payer</strong>, so invoices are <strong>without VAT</strong>. If you need an invoice with VAT, please email <strong>info@barovainventura.sk</strong> — we can arrange it after consultation.',
                ],
            ],
        ],
    ],

    // CONTACT
    'contact' => [
        'breadcrumb_title' => 'Contact Us',
        'breadcrumb_text'  => 'If you have a question, contact us — we’ll reply as soon as possible.',
        'breadcrumb_home'  => 'Home',

        'form_title' => 'Leave a <span>message</span>',
        'form_text'  => 'Fill out the form below and our team will get back to you shortly.',
        'name'       => 'Name',
        'email'      => 'Email',
        'company'    => 'Company name',
        'country'    => 'Country',
        'phone'      => 'Phone',
        'website'    => 'Website',
        'message'    => 'Your message',
        'agree'      => 'I agree to receive emails, newsletters, and promotional messages',
        'send'       => 'SEND MESSAGE',

        'info_title' => 'Have a <span>question?</span>',
        'info_text'  => 'If you have any questions about our product, service, payment, or company, visit our',
        'read_faq'   => 'FAQ',

        'email_us' => 'Email us',
        'call_us'  => 'Call us',
        'visit_us' => 'Headquarters',

        'success' => 'Your message has been sent successfully. We’ll get back to you soon.',
        'error'   => 'An error occurred while sending the message. Please try again later.',
    ],

    'header' => [
        'home'         => 'Home',
        'features'     => 'Features',
        'how_it_works' => 'How it works',
        'pricing'      => 'Pricing',
        'tutorials'    => 'Tutorials & Video',
        'download'     => 'Downloads',
        'contact'      => 'Contact',
        'login'        => 'Log in',
        'register'     => 'Start for free',
    ],

    'footer' => [
        'useful_links' => 'Useful links',
        'help_support' => 'Help & Support',
        'try_out'      => 'Try it',
        'tutorials'    => 'Tutorials & Video',
        'download'     => 'Downloads',
        'vop'          => 'Terms & Conditions',
        'gdpr'         => 'GDPR',
        'pricing'      => 'Pricing',
        'cookie'       => 'Cookie',
        'about'        => 'Our team',
        'contact'      => 'Contact',
        'faq'          => 'FAQ',
        'pc_app'       => 'PC App',
        'user_manual'  => 'User Manual',
        'support'      => 'Support',
        'created_by'   => 'Created by',
    ],

    'getstarted' => [
        'title'    => 'Download the PC app and start your inventory',
        'subtitle' => 'Log in to the created inventory, connect your scale and scanner, and scan bottles. You’ll get the export after processing in the admin (1–2 min).',
        'btns' => [
            'download' => 'Download PC App (Windows)',
            'guides'   => 'Tutorials & Video',
        ],
        'alts' => [
            'anim'   => 'Animation',
            'thumb1' => 'Preview — downloading the app',
            'thumb2' => 'Preview — mobile scanner',
        ],
    ],

    'faq' => [
        'title' => 'Have questions? Start here',
        'breadcrumbs' => [
            'home' => 'Home',
            'faq'  => 'FAQ',
        ],
        'items' => [
            [
                'q' => 'What is Bar Inventory?',
                'a' => 'Bar Inventory is an online tool for pubs, bars, restaurants, and other venues that lets you quickly and accurately track stock of beverages and food, monitor sales, and optimize purchasing.',
            ],
            [
                'q' => 'Does Bar Inventory have its own product database?',
                'a' => 'Yes, Bar Inventory includes tens of thousands of products, so you just scan a barcode and the product is found. If we don’t have the product in the database, the system prompts you to add it and shows fields to fill in so you can continue inventorying. The saved data is then reviewed by an administrator and added to the database, so it’s a one-time step.',
            ],
            [
                'q' => 'Is the container weight subtracted during weighing?',
                'a' => 'Yes, the system uses the parameters for empty container weight, which it subtracts from the measured weight of the product. A tolerance of 10 grams is set, for example if there is fruit in the bottle.',
            ],
            [
                'q' => 'How does Bar Inventory work?',
                'a' => 'The system uses simple input of stock levels and consumption. The data is processed into clear reports that help identify losses, monitor staff, and plan purchasing efficiently.',
            ],
            [
                'q' => 'Do I need special equipment or devices?',
                'a' => 'Bar Inventory can be used without a digital scale and barcode scanner, which is suitable for venues with up to 20 product types. If you have more than 20 product types, we recommend using our hardware for speed and efficiency.',
            ],
            [
                'q' => 'How much does Bar Inventory cost?',
                'a' => 'The price depends only on the number of outlets. The standard price per outlet is €20 per month.',
            ],
            [
                'q' => 'Can I use Bar Inventory without the internet?',
                'a' => 'No, as it’s a cloud solution, an internet connection is required.',
            ],
            [
                'q' => 'How does Bar Inventory help reduce losses?',
                'a' => 'Accurate tracking of consumption reveals differences between sales and actual stock levels. This helps you quickly identify where losses occur — whether due to mistakes, poor pouring, or intentional shrinkage.',
            ],
            [
                'q' => 'Can I export data?',
                'a' => 'Yes, Bar Inventory allows data export in multiple formats — for accounting systems, warehouse systems, and other external apps. Exported files can be further adjusted to match a specific external system.',
            ],
            [
                'q' => 'Do you provide training for using the system?',
                'a' => 'We provide online guides on the website. For training or technical intervention, please email <strong>sales@barovainventura.sk</strong>.',
            ],
            [
                'q' => 'How quickly can I start using the system?',
                'a' => 'After account activation, you can start using Bar Inventory within 10–20 minutes.',
            ],
            [
                'q' => 'Do you provide technical support?',
                'a' => 'Yes, customer support is available via email and phone.',
            ],
            [
                'q' => 'Can Bar Inventory work across multiple outlets at once?',
                'a' => 'Yes, the system supports multiple outlets within one account, each with its own stock, sales, and reports.',
            ],
            [
                'q' => 'Can I add an unlimited number of products?',
                'a' => 'Yes, you can add any number of products. Product categories are not supported.',
            ],
            [
                'q' => 'Can the system track minimum stock levels?',
                'a' => 'Yes, you can set minimum stock levels and the system will alert you when it’s time to restock.',
            ],
            [
                'q' => 'Can I try the system before purchasing?',
                'a' => 'Yes, we offer a free trial period to test the system.',
            ],
            [
                'q' => 'Can I use Bar Inventory on mobile?',
                'a' => 'Yes, the system is fully responsive and optimized for use on mobile devices and tablets.',
            ],
            [
                'q' => 'Can the system handle partially opened bottles?',
                'a' => 'Yes, you can record partially opened bottles and the system will automatically convert quantities to liters or milliliters.',
            ],
            [
                'q' => 'Can I set access permissions for different users?',
                'a' => 'No, the system currently does not support user permissions (roles).',
            ],
            [
                'q' => 'Does Bar Inventory track change history?',
                'a' => 'Yes, all changes are recorded in the history, so you always know who made edits and when.',
            ],
            [
                'q' => 'Can Bar Inventory be integrated with a POS system?',
                'a' => 'Yes, the system can be integrated with various POS systems. If we don’t currently support your system, just contact us at <strong>info@barovainventura.sk</strong> and we’ll do our best to connect it to our platform.',
            ],
            [
                'q' => 'How often is the system updated?',
                'a' => 'Bar Inventory is updated regularly to add new features, improve performance, and enhance security. Updates are automatic with no downtime.',
            ],
        ],
    ],

    'tutorial' => [
        'title' => 'Watch quick demos of working with the Bar Inventory system',
        'breadcrumbs' => [
            'home'  => 'Home',
            'title' => 'Tutorials',
        ],

        'hero' => [
            'title_html' => '<span>Video</span> tutorials',
            'subtitle'   => 'Watch quick demos of the Bar Inventory system — from registration to calibration and exports.',
        ],

        'cards' => [
            [
                'img'        => 'web/images/standard.png',
                'img_alt'    => 'Registration',
                'title'      => 'Getting started & sign-in',
                'subtitle'   => 'Sign in to the app',
                'bullets'    => [
                    'Sign in to the admin',
                    'Create an inventory',
                    'Sign in to the app',
                ],
                'video_url'  => 'https://www.youtube.com/embed/9p0-TTMRJ8g?autoplay=1&mute=0',
                'video_cta'  => 'Play video',
                'video_title'=> 'Video tutorial — Introduction',
            ],
            [
                'img'        => 'web/images/unlimited.png',
                'img_alt'    => 'Installation',
                'title'      => 'Installation',
                'subtitle'   => 'Install the PC app',
                'bullets'    => [
                    'Download the PC app',
                    'Allow through Defender',
                    'Install the PC app',
                ],
                'video_url'  => 'https://www.youtube.com/embed/-CT2UDn5JjY?autoplay=1&mute=0',
                'video_cta'  => 'Play video',
                'video_title'=> 'Video tutorial — Installation',
            ],
            [
                'img'        => 'web/images/premium.png',
                'img_alt'    => 'Scale calibration',
                'title'      => 'Scale',
                'subtitle'   => 'Calibrate the scale',
                'bullets'    => [
                    'Introducing the BI V scale',
                    'Scale calibration',
                    'Calibration check',
                ],
                'video_url'  => 'https://www.youtube.com/embed/_nCp19VkxzQ?autoplay=1&mute=0',
                'video_cta'  => 'Play video',
                'video_title'=> 'Video tutorial — Scale calibration',
            ],
        ],

        'faq' => [
            [
                'q' => 'What if I can’t find the tutorial I need?',
                'a' => 'If you can’t find the tutorial you need, contact us at <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a> and we’ll gladly prepare a custom guide for you.',
            ],
            [
                'q' => 'I have an issue that’s only partially covered in the video.',
                'a' => 'Feel free to contact us — we’ll be happy to add details and explain everything. We can communicate by email or phone, and we also provide support via remote desktop (AnyDesk).',
            ],
            [
                'q' => 'How much does support cost?',
                'a' => 'Support via phone or email, as well as screen sharing, is free. We value our customers and are happy to invest our time to help.',
            ],
            [
                'q' => 'What should I do if I want someone to explain it on-site?',
                'a' => 'Please arrange an on-site session by emailing <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a>. We’ll then schedule a technician to visit your venue at an agreed time.',
            ],
        ],
    ],
];
