<?php
declare(strict_types=1);

/**
 * Content for the four service groups. Keyed by URL slug.
 *
 * Fields per group:
 *  name, short, icon         — nav/cards
 *  title, description        — <title> / meta description
 *  eyebrow, h1[3], lead      — page hero (h1 = line, accent line, highlight line)
 *  offerings[]               — {icon, name, desc, tags[]} cards
 *  process[]                 — {title, desc} steps
 *  deliverables[]            — "what you get" checklist
 *  faqs[]                    — {q, a}; also emitted as FAQPage JSON-LD
 *  related[]                 — slugs of other groups to cross-link
 */
return [
    'web-and-apps' => [
        'name' => 'Web & App Development',
        'short' => 'Websites, online stores, custom web apps and mobile apps — designed, built and supported by one team.',
        'icon' => 'fa-laptop-code',
        'title' => 'Website, Web App & Mobile App Development',
        'description' => 'Custom website design and development, e-commerce stores, web applications and iOS & Android apps — built for speed, search and conversions by the digivyb team.',
        'eyebrow' => 'Web & App Development',
        'h1' => ['Websites and apps', 'built to bring in business,', 'not just to look good.'],
        'lead' => 'From a five-page business site to a custom booking platform or a mobile app, we design and build digital products around one question: what should a visitor do next? Fast, secure, and easy for your team to manage.',
        'offerings' => [
            [
                'icon' => 'fa-globe',
                'name' => 'Website Design & Development',
                'desc' => 'Custom-designed, responsive websites for businesses that need to look credible and convert. Designed in Figma first, built for speed, and set up so your team can edit content without calling us.',
                'tags' => ['Responsive design', 'CMS-editable', 'SEO-ready'],
            ],
            [
                'icon' => 'fa-cart-shopping',
                'name' => 'E-Commerce Stores',
                'desc' => 'Online stores on Shopify, WooCommerce or a custom build — product pages, checkout and payments, tested end to end before your customers ever see them.',
                'tags' => ['Shopify', 'WooCommerce', 'Payment gateways'],
            ],
            [
                'icon' => 'fa-gears',
                'name' => 'Custom Web Applications',
                'desc' => 'Dashboards, client portals, booking systems and internal tools shaped around how your business actually runs — for when off-the-shelf software almost fits, but not quite.',
                'tags' => ['Portals & dashboards', 'APIs & integrations', 'User accounts'],
            ],
            [
                'icon' => 'fa-mobile-screen-button',
                'name' => 'Mobile App Development',
                'desc' => 'iOS and Android apps built from a single codebase where that makes sense, and native where it does not. We handle design, development, testing and App Store / Play Store submission.',
                'tags' => ['iOS & Android', 'Cross-platform', 'Store launch'],
            ],
            [
                'icon' => 'fa-compass-drafting',
                'name' => 'UI/UX Design & Redesigns',
                'desc' => 'Wireframes, clickable prototypes and polished interfaces designed around how your users really behave. Already have a site that underperforms? We will audit it and redesign what is holding it back.',
                'tags' => ['Figma prototypes', 'UX audits', 'Design systems'],
            ],
            [
                'icon' => 'fa-screwdriver-wrench',
                'name' => 'Support & Maintenance',
                'desc' => 'Launch day is not the finish line. Updates, security patches, backups, uptime monitoring and small improvements on a simple monthly plan, with a real person on the other end of the email.',
                'tags' => ['Updates & backups', 'Security patches', 'Monitoring'],
            ],
        ],
        'process' => [
            ['title' => 'Discover', 'desc' => 'We learn your business, your audience and your goals, then agree scope, timeline and a fixed quote before any work starts.'],
            ['title' => 'Design', 'desc' => 'Wireframes and clickable prototypes you can react to and revise, so there are no surprises once development begins.'],
            ['title' => 'Build', 'desc' => 'Development in stages with regular demos, then testing across devices and browsers before anything goes live.'],
            ['title' => 'Launch & support', 'desc' => 'We deploy, hand over, walk your team through the admin, and stay on for maintenance and improvements.'],
        ],
        'deliverables' => [
            'A fixed-price quote agreed before work begins',
            'Mobile-first design that works on every screen size',
            'Basic on-page SEO and analytics set up at launch',
            'Clear handover of files, code and logins at completion',
            'Training so your team can manage content themselves',
            'A post-launch support window for fixes and questions',
        ],
        'faqs' => [
            [
                'q' => 'How long does a website take?',
                'a' => 'A typical business website takes three to six weeks from kickoff to launch, depending on the number of pages, how ready your content is, and how many revision rounds you need. Web apps and mobile apps are scoped in phases, and we give you a timeline before you commit.',
            ],
            [
                'q' => 'Do you build on WordPress, or something custom?',
                'a' => 'Both. WordPress is a great fit for content-driven sites and blogs, and we also build custom PHP and modern JavaScript sites when a project needs more control. We recommend what suits your goals rather than defaulting to one tool.',
            ],
            [
                'q' => 'Can you redesign my existing website?',
                'a' => 'Yes. We start with a short audit of what is and is not working — design, speed, search visibility and conversions — and then redesign around that, keeping what already performs well.',
            ],
            [
                'q' => 'What does a project cost?',
                'a' => 'Every project is scoped individually, so we give you a fixed quote after a short discovery call. There are no hidden fees: if the scope changes, we agree the change with you before doing the work.',
            ],
            [
                'q' => 'Will you look after the site after it launches?',
                'a' => 'If you want us to. Maintenance plans cover updates, security patches, backups and monitoring, and we can keep improving the site alongside our SEO and content services.',
            ],
        ],
        'related' => ['seo-and-ads', 'creative-studio'],
    ],

    'seo-and-ads' => [
        'name' => 'SEO & Advertising',
        'short' => 'Get found on Google and reach ready-to-buy customers with search optimisation and paid campaigns.',
        'icon' => 'fa-chart-line',
        'title' => 'SEO & Advertising — Google Ads, Meta Ads & Search Optimisation',
        'description' => 'SEO, Google Ads and Meta ad campaigns managed by digivyb. Honest strategy, proper tracking and plain-language reporting focused on enquiries and sales.',
        'eyebrow' => 'SEO & Advertising',
        'h1' => ['Be found when', 'customers are searching,', 'and win them when they click.'],
        'lead' => 'Search and paid advertising are two ways to reach people who are already looking for what you sell. We combine them: SEO for steady, compounding visibility and ads for immediate reach — both measured against enquiries and sales, not vanity metrics.',
        'offerings' => [
            [
                'icon' => 'fa-magnifying-glass-chart',
                'name' => 'SEO Audit & Strategy',
                'desc' => 'A clear picture of where you stand: how your site is performing, what your competitors rank for, and which keywords are worth going after. You get a prioritised plan, not a 60-page report nobody reads.',
                'tags' => ['Site audit', 'Keyword research', 'Competitor analysis'],
            ],
            [
                'icon' => 'fa-code',
                'name' => 'Technical & On-Page SEO',
                'desc' => 'Page speed, crawlability, site structure, metadata, schema markup and content optimisation — fixing what stops search engines (and visitors) from getting the most out of your pages.',
                'tags' => ['Core Web Vitals', 'Schema markup', 'Site structure'],
            ],
            [
                'icon' => 'fa-map-location-dot',
                'name' => 'Local SEO',
                'desc' => 'Show up in "near me" searches and on Google Maps. We set up and optimise your Google Business Profile, local listings and reviews strategy so nearby customers can find and trust you.',
                'tags' => ['Google Business Profile', 'Local listings', 'Reviews'],
            ],
            [
                'icon' => 'fa-rectangle-ad',
                'name' => 'Google Ads',
                'desc' => 'Search, Display, Shopping and YouTube campaigns built around buying intent. We handle keyword targeting, ad copy, landing pages and bid management, and cut spend that is not earning its place.',
                'tags' => ['Search & Shopping', 'Display & YouTube', 'Landing pages'],
            ],
            [
                'icon' => 'fa-share-nodes',
                'name' => 'Meta & Social Ads',
                'desc' => 'Facebook, Instagram and LinkedIn campaigns for awareness, leads and sales, with creative and copy tested against each other so budget flows to what actually works.',
                'tags' => ['Facebook & Instagram', 'LinkedIn', 'Retargeting'],
            ],
            [
                'icon' => 'fa-chart-pie',
                'name' => 'Tracking & Reporting',
                'desc' => 'Analytics, conversion tracking and call/form tracking set up properly before any money is spent, then reported back each month in plain language: what happened, why, and what we will do next.',
                'tags' => ['GA4 & Tag Manager', 'Conversion tracking', 'Monthly reports'],
            ],
        ],
        'process' => [
            ['title' => 'Audit', 'desc' => 'We review your website, tracking, competitors and current marketing to see what is working and where the biggest opportunities are.'],
            ['title' => 'Plan', 'desc' => 'We agree priorities, channels, budget and the targets that matter to your business — enquiries, sales or bookings.'],
            ['title' => 'Execute', 'desc' => 'We fix the site, publish the content and launch the campaigns, testing ads and pages against each other as we go.'],
            ['title' => 'Report & refine', 'desc' => 'Every month you get a plain-language report, and we adjust the plan based on the numbers, not on guesses.'],
        ],
        'deliverables' => [
            'Tracking and analytics set up before any ad spend begins',
            'Keyword and competitor research tailored to your market',
            'A prioritised action plan, not just a list of problems',
            'Ad accounts set up so you keep access and visibility',
            'Plain-language monthly reports with next steps',
            'A single team across your website, SEO and ads',
        ],
        'faqs' => [
            [
                'q' => 'How long does SEO take to show results?',
                'a' => 'SEO is gradual. Many sites begin to see movement within three to six months, depending on competition, the current state of the site and how much content is needed. Paid ads can bring traffic much sooner, which is why we often combine the two.',
            ],
            [
                'q' => 'Can you guarantee first-page rankings?',
                'a' => 'No — and be cautious of anyone who does. Search engines decide rankings, not agencies. What we commit to is a clear plan, careful execution and honest reporting on what is and is not working.',
            ],
            [
                'q' => 'How much should I spend on ads?',
                'a' => 'It depends on your market, margins and goals. We help you set a sensible test budget, learn what converts, and then scale what works. Ad spend is paid directly to the platform; our management fee is separate and agreed up front.',
            ],
            [
                'q' => 'Which advertising platforms do you work with?',
                'a' => 'Google Ads (Search, Display, Shopping and YouTube), Meta (Facebook and Instagram) and LinkedIn. We will recommend the channels where your customers actually spend time rather than spreading budget everywhere.',
            ],
            [
                'q' => 'Do I need a new website to start SEO or ads?',
                'a' => 'Not always. We audit what you have first. If the site is slow, hard to use or does not convert, we will say so and show you what to fix — sending paid traffic to a weak page just wastes budget.',
            ],
        ],
        'related' => ['content-and-social', 'web-and-apps'],
    ],

    'creative-studio' => [
        'name' => 'Creative Studio',
        'short' => 'Branding, graphic design, motion graphics and video editing that make your business look established.',
        'icon' => 'fa-pen-nib',
        'title' => 'Creative Studio — Graphic Design, Motion Graphics & Video Editing',
        'description' => 'Logo and brand identity, graphic design, motion graphics, video editing and ad creatives from the digivyb creative studio.',
        'eyebrow' => 'Creative Studio',
        'h1' => ['Design and motion', 'that make people', 'stop scrolling.'],
        'lead' => 'People judge a brand in seconds. Our creative team designs, animates and edits the visuals that make a growing business look established — and keeps that look consistent across your website, social feeds, ads and print.',
        'offerings' => [
            [
                'icon' => 'fa-swatchbook',
                'name' => 'Logo & Brand Identity',
                'desc' => 'A logo, colour palette and typography system that fits who you are and who you want to reach. We explore more than one direction so you choose with confidence, not by default.',
                'tags' => ['Logo design', 'Colour & type', 'Identity systems'],
            ],
            [
                'icon' => 'fa-book-open',
                'name' => 'Brand Guidelines',
                'desc' => 'A simple, practical rulebook for how your brand looks and sounds, so everyone who touches it — staff, freelancers, printers — keeps it consistent.',
                'tags' => ['Usage rules', 'Templates', 'Brand voice'],
            ],
            [
                'icon' => 'fa-palette',
                'name' => 'Graphic Design',
                'desc' => 'Social media graphics, brochures, flyers, presentation decks, packaging and print collateral — designed to be clear, on-brand and ready for every channel.',
                'tags' => ['Social graphics', 'Print & brochures', 'Pitch decks'],
            ],
            [
                'icon' => 'fa-wand-magic-sparkles',
                'name' => 'Motion Graphics',
                'desc' => 'Animated logos, explainer videos, social animations and kinetic typography that bring ideas to life and hold attention far better than a static image.',
                'tags' => ['Logo animation', 'Explainers', 'Social animation'],
            ],
            [
                'icon' => 'fa-clapperboard',
                'name' => 'Video Editing',
                'desc' => 'Promos, reels, YouTube videos, testimonials and event recaps — cut for pace, with colour, sound, captions and graphics so they look professional on any platform.',
                'tags' => ['Reels & Shorts', 'Promos', 'Captions & sound'],
            ],
            [
                'icon' => 'fa-bullseye',
                'name' => 'Ad Creatives',
                'desc' => 'Image and video ad variations built for Meta, Google and LinkedIn, designed to be tested against each other so you can see which message and visual earn the clicks.',
                'tags' => ['Static & video ads', 'A/B variations', 'Platform sizes'],
            ],
        ],
        'process' => [
            ['title' => 'Brief', 'desc' => 'We learn about your business, audience and competitors, and agree what the work needs to achieve and where it will be used.'],
            ['title' => 'Concepts', 'desc' => 'We present ideas and directions for you to react to, so we are solving the right problem before polishing details.'],
            ['title' => 'Refine', 'desc' => 'We develop the chosen direction through revision rounds agreed at the start, keeping feedback focused and the project moving.'],
            ['title' => 'Deliver', 'desc' => 'You receive final files in every format you need — web, social, video and print — organised and ready to use.'],
        ],
        'deliverables' => [
            'Multiple concept directions for identity projects',
            'Revision rounds agreed clearly at the start',
            'Platform-ready sizes for social, web, video and print',
            'Editable source files where applicable',
            'Consistent styling across everything we create for you',
            'Fast turnaround on repeat work once your look is set',
        ],
        'faqs' => [
            [
                'q' => 'Do I need to supply the footage for video editing?',
                'a' => 'Usually, yes: you provide the raw footage and we handle the edit, colour, sound, captions and graphics. If you are planning a shoot, we can brief you on what to capture so the editing goes smoothly.',
            ],
            [
                'q' => 'How many revisions are included?',
                'a' => 'We agree the number of revision rounds at the start of each project — typically two — so feedback stays focused and timelines stay predictable. Extra rounds are always possible and quoted up front.',
            ],
            [
                'q' => 'Can you work with our existing brand?',
                'a' => 'Absolutely. If you already have a logo and guidelines we will follow them. If they are missing or outdated, we can tidy them up or build them out without starting from scratch.',
            ],
            [
                'q' => 'What file formats will I receive?',
                'a' => 'Whatever you need: web-ready PNG, JPG and SVG, print-ready PDFs, MP4 video for every major platform, and editable source files where applicable.',
            ],
            [
                'q' => 'Can you create content on an ongoing basis?',
                'a' => 'Yes. Many clients use us monthly for social creatives, ad variations and short videos. Once your look is established, repeat work is faster and more consistent.',
            ],
        ],
        'related' => ['content-and-social', 'seo-and-ads'],
    ],

    'content-and-social' => [
        'name' => 'Content & Social Media',
        'short' => 'Social media management, content writing and copywriting that build trust before the first conversation.',
        'icon' => 'fa-pen-fancy',
        'title' => 'Content Writing, Copywriting & Social Media Management',
        'description' => 'Social media management, content writing and copywriting for websites, ads and email — planned, written and published by the digivyb team.',
        'eyebrow' => 'Content & Social Media',
        'h1' => ['Words and a presence', 'that build trust', 'before the first call.'],
        'lead' => 'People research before they buy. Strong writing and a consistent social presence help your business show up, sound credible and stay top of mind. We plan, write, design, post and report, so you do not have to.',
        'offerings' => [
            [
                'icon' => 'fa-hashtag',
                'name' => 'Social Media Management',
                'desc' => 'We run your accounts end to end: planning, designing, scheduling and publishing posts, responding to comments and tracking what resonates. You approve the content; we do the work.',
                'tags' => ['Instagram & Facebook', 'LinkedIn', 'Scheduling & posting'],
            ],
            [
                'icon' => 'fa-calendar-days',
                'name' => 'Content Strategy & Calendars',
                'desc' => 'A clear plan for what to say, to whom and when: content pillars, topics, formats and a calendar built around your goals and what your audience cares about.',
                'tags' => ['Content pillars', 'Monthly calendars', 'Audience research'],
            ],
            [
                'icon' => 'fa-newspaper',
                'name' => 'Content Writing',
                'desc' => 'Blog posts, articles, case studies, newsletters and long-form guides that answer real customer questions, informed by keyword research so they can bring in search traffic too.',
                'tags' => ['Blogs & articles', 'Case studies', 'Newsletters'],
            ],
            [
                'icon' => 'fa-pen-fancy',
                'name' => 'Website Copywriting',
                'desc' => 'Clear, persuasive copy for homepages, service pages and landing pages that explains what you do, why it matters and what to do next — in your voice, not in jargon.',
                'tags' => ['Homepages', 'Service pages', 'Landing pages'],
            ],
            [
                'icon' => 'fa-envelope-open-text',
                'name' => 'Ad & Email Copywriting',
                'desc' => 'Headlines, ad text, email sequences and product descriptions written to earn the click and the reply, then tested against alternatives so the best version wins.',
                'tags' => ['Ad copy', 'Email sequences', 'Product descriptions'],
            ],
            [
                'icon' => 'fa-users',
                'name' => 'Community & Reporting',
                'desc' => 'We respond to comments and messages in your voice, keep an eye on mentions, and send a monthly report showing reach, engagement and what to do more of.',
                'tags' => ['Engagement', 'Mentions', 'Monthly reports'],
            ],
        ],
        'process' => [
            ['title' => 'Listen', 'desc' => 'We learn your brand voice, your audience and your goals, and look at what your competitors are doing well.'],
            ['title' => 'Plan', 'desc' => 'We agree content pillars, topics and a calendar, so you always know what is coming and why.'],
            ['title' => 'Create', 'desc' => 'We write, design and draft everything. You review and approve before anything is published.'],
            ['title' => 'Publish & measure', 'desc' => 'We post on schedule, engage with your audience and report on results, then fold what we learn into the next month.'],
        ],
        'deliverables' => [
            'A content calendar planned ahead of each month',
            'Your approval before anything goes live',
            'Writing in a brand voice we agree together',
            'Articles informed by keyword research for search',
            'Designed social graphics alongside the written posts',
            'Plain-language monthly performance reports',
        ],
        'faqs' => [
            [
                'q' => 'Which social platforms do you manage?',
                'a' => 'Instagram, Facebook, LinkedIn and YouTube are the most common. We will recommend the platforms where your customers actually spend time, rather than posting everywhere for the sake of it.',
            ],
            [
                'q' => 'Do I get to approve posts before they go live?',
                'a' => 'Yes. We share the content calendar and drafts in advance, you review and approve, and only then do we schedule and publish.',
            ],
            [
                'q' => 'How often will you post?',
                'a' => 'Posting frequency is set in your plan based on your goals and budget. Consistency matters more than volume — a sustainable rhythm beats a burst of posts that tails off.',
            ],
            [
                'q' => 'Will the content help with SEO?',
                'a' => 'Our written content is planned with keyword research and written to answer real questions, and our SEO team can connect it to your wider search strategy so each piece works harder.',
            ],
            [
                'q' => 'Can you match our brand voice?',
                'a' => 'That is the starting point. We learn how you speak, review your existing material and agree a short voice guide, so everything we write sounds like your business and not like generic marketing.',
            ],
        ],
        'related' => ['creative-studio', 'seo-and-ads'],
    ],
];
