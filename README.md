# Pakistan Utility Bills Web App

## Project Overview

This project is a Laravel based web application designed to become **Pakistan’s default utility bill companion**.

This is not a one time bill checking website.

The long term goal is to build a **habit forming product** that Pakistani users instinctively return to every month when thinking about electricity, gas, or internet bills.

The short term success metric is **user signup**.  
The long term success metric is **monthly retention**.

SEO is the primary acquisition channel.  
UX and perceived premium quality drive conversion and loyalty.

---

## Core Problem We Are Solving

Pakistani users face multiple problems with utility bills:

- Bills arrive unpredictably
- Official provider websites are slow, confusing, or unreliable
- Users forget due dates and incur late payment surcharges
- Reference numbers are lost or re entered every month
- There is no single place to manage all utility bills

Existing solutions feel:
- Government style
- Cluttered
- Trustless
- One time use

This project aims to fix that.

---

## Product Vision

When a user thinks:
- Has my bill arrived
- What is my due date
- How much was last month
- Let me quickly check my bill

This app should be the **first and default choice**.

The product must feel:
- Calm
- Clean
- Premium
- Trustworthy
- Modern
- Purposeful

---

## Technology Stack

- Laravel (Backend and routing)
- Blade templates (Server side rendering)
- Tailwind CSS (UI styling)
- Minimal JavaScript (Performance first)
- MySQL or compatible database
- SEO first architecture

No SPA.
No heavy frontend frameworks.
Fast page loads are critical.

---

## Authentication Status

Authentication is already implemented.

The following pages and flows already exist and must not be rebuilt:
- Login
- Signup
- Dashboard
- Auth middleware
- User session handling

All new features must **integrate into the existing auth system**.

---

## High Level Architecture

### Controllers

- `PageController`
  - Handles all SEO pages
  - Provider pages
  - Category hub pages
  - Guides and evergreen content

- `BillController`
  - Handles bill lookup flow
  - Input validation
  - Result rendering
  - Noindex result pages

### Views

- `layouts/`
  - Base Blade layout
  - Handles meta tags, canonical URLs, schema injection

- `hubs/`
  - electricity.blade.php
  - gas.blade.php
  - internet.blade.php

- `providers/`
  - iesco.blade.php
  - lesco.blade.php
  - sngpl.blade.php
  - Other providers follow same structure

- `bill/`
  - result.blade.php

- `dashboard/`
  - Existing dashboard views
  - Saved bills integration

---

## SEO Strategy (Critical)

SEO is the primary growth channel.

### Entry Points

Users land mostly on:
- Provider pages
- Category hub pages
- Guide pages

Homepage is secondary.

---

### Provider Pages

Each utility provider has its own page.

Examples:
- /iesco-bill-online
- /lesco-bill-online
- /sngpl-bill-online
- /ptcl-bill-online

Each provider page includes:
- Unique title and meta description
- One H1 with primary keyword
- Pre selected bill check form
- Clear explanation of value
- Signup persuasion blocks
- Detailed content sections
- FAQ with FAQPage JSON LD
- Roman Urdu content block
- Internal links
- Minimum 700 words of unique content

These pages are **fully indexable**.

---

### Category Hub Pages

Category hubs act as SEO authority pages and navigation targets.

Routes:
- /electricity-bill-online
- /gas-bill-online
- /internet-bill-online

Each hub page:
- Targets broad keywords
- Lists all providers
- Links to provider pages
- Explains why saving bills matters
- Contains soft signup CTAs

---

### Result Pages

Bill result pages must **never be indexed**.

Implementation:
- meta robots noindex, nofollow
- canonical pointing back to provider page

Reason:
- Prevent infinite parameter indexing
- Keep SEO clean and controlled

---

## Bill Lookup Flow

All bill lookup forms submit to:

GET /check-duplicate-bill

Parameters:
- type (electricity, gas, internet)
- provider
- reference_number

Current behaviour:
- Inputs validated
- Provider normalised
- Reference number masked
- Placeholder result rendered

Real bill fetching will be integrated later.

---

## User Retention Strategy

### Signup is the main conversion

Checking a bill is the hook.  
Saving the bill is the habit.  
Signup enables ownership.

UX must always communicate:
- Save time next month
- One click bill checking
- Bill history
- Due date awareness
- Centralised dashboard

No aggressive popups.
No forced modals.

---

### Saved Bills

- Logged in users can save:
  - Provider
  - Reference number
  - Nickname

- Saved bills appear in dashboard
- Each saved bill shows:
  - Provider name
  - Last checked date
  - Check now button

Guest users:
- See benefits explanation
- Encouraged to sign up

---

## UX Philosophy

This app must not feel like a typical Pakistani utility website.

Principles:
- Minimal
- Calm spacing
- Clear hierarchy
- Short helpful copy
- No clutter
- Premium visual tone

UX patterns to reinforce habit:
- Recognition (welcome back, last checked)
- Reduction (one click checking)
- Anticipation (bill expected soon)
- Ownership (your bills, your dashboard)

---

## Performance Rules

- Minimal JavaScript
- No blocking scripts
- Mobile first layouts
- Fast initial render
- SEO friendly HTML

---

## Routing Principles

- All routes are named
- Slugs are human readable
- URLs reflect search intent
- No query based SEO pages

---

## Future Roadmap (Do Not Implement Yet)

- Real time bill fetching
- Email reminders
- SMS reminders
- Bill analytics
- Monthly spending trends
- Payment integrations
- PWA support

These are intentionally deferred.

---

## Development Guidelines

When adding new features, always ask:

- Does this improve SEO reach
- Does this improve user trust
- Does this encourage signup
- Does this increase likelihood of return visit

If the answer is no, rethink the change.

---

## Final Note for AI Editors

This project prioritises:
1. SEO driven traffic
2. Premium UX
3. Habit formation
4. Signup conversion
5. Long term retention

Do not optimise for quick hacks or shortcuts.

Build deliberately.

