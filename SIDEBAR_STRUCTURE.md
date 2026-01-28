# Unified Sidebar Structure

## Layout Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    UNIFIED APP LAYOUT                       │
├──────────────────┬──────────────────────────────────────────┤
│                  │                                          │
│   SIDEBAR        │         MAIN CONTENT AREA               │
│   (sticky)       │                                          │
│                  │  ┌────────────────────────────────────┐ │
│  ┌────────────┐  │  │  TOP NAVBAR (hidden on dashboard) │ │
│  │   LOGO     │  │  │  - Page title                      │ │
│  │   EXM      │  │  │  - Quick actions menu              │ │
│  └────────────┘  │  └────────────────────────────────────┘ │
│                  │                                          │
│  ┌────────────┐  │  ┌────────────────────────────────────┐ │
│  │ NAVIGATION │  │  │                                    │ │
│  │ ────────── │  │  │      PAGE CONTENT                  │ │
│  │ Dashboard  │  │  │      (Dashboard / Categories /     │ │
│  │ Categories │  │  │       Expenses / Forms)            │ │
│  │ Expenses   │  │  │                                    │ │
│  └────────────┘  │  └────────────────────────────────────┘ │
│                  │                                          │
│  ┌────────────┐  │                                          │
│  │  SPACER    │  │                                          │
│  └────────────┘  │                                          │
│                  │                                          │
│  ┌────────────┐  │                                          │
│  │  PROFILE   │  │                                          │
│  │  (bottom)  │  │                                          │
│  └────────────┘  │                                          │
│                  │                                          │
└──────────────────┴──────────────────────────────────────────┘
```

## Component Hierarchy

### Sidebar Components (Unified)
```
<flux:sidebar>
  ├── Logo Section
  │   ├── favicon.png
  │   └── "EXM" text
  │
  ├── Navigation List
  │   ├── Dashboard (icon: chart-bar)
  │   ├── Categories (icon: tag)
  │   └── Expenses (icon: credit-card)
  │
  ├── Spacer (flex-1)
  │
  └── Profile Section (bottom)
      ├── Avatar + Name Button
      └── Dropdown Menu
          ├── Profile
          ├── Settings
          └── Logout
```

### Navigation Styling (Consistent)
- **Variant:** outline
- **Spacing:** px-2 space-y-1
- **Icons:** 24px (Heroicons)
- **Active State:** Current route highlighted
- **Hover State:** Smooth transition with background color

### Profile Section Styling (Consistent)
- **Position:** Bottom of sidebar (mt-auto)
- **Separator:** Top border (border-zinc-200/50 dark:border-zinc-800/50)
- **Padding:** p-3
- **Avatar:** 8x8 size, gradient background
- **Dropdown:** Opens upward (position="top")
- **Menu Items:** Profile, Settings, Logout

## Pages Using Unified Layout

### Dashboard
- Route: `/dashboard`
- Component: Blade view (uses `<x-layouts.app>`)
- Sidebar: ✓ Unified
- Navbar: Hidden (dashboard-specific)

### Categories
- Index: `/categories` (Livewire)
- Create: `/categories/create` (Livewire)
- Edit: `/categories/{id}/edit` (Livewire)
- Component: Extends `BaseComponent`
- Sidebar: ✓ Unified
- Navbar: ✓ Visible with title and quick actions

### Expenses
- Index: `/expenses` (Livewire)
- Create: `/expenses/create` (Livewire)
- Edit: `/expenses/{id}/edit` (Livewire)
- Component: Extends `BaseComponent`
- Sidebar: ✓ Unified
- Navbar: ✓ Visible with title and quick actions

## Consistency Metrics

| Aspect | Value | Applied To |
|--------|-------|-----------|
| Sidebar Width | 16rem (256px) | All pages |
| Logo Size | 32px | All pages |
| Navigation Spacing | 4px (space-y-1) | All pages |
| Icon Size | 24px | All pages |
| Profile Avatar | 32px | All pages |
| Border Color | zinc-200/50 dark:zinc-800/50 | All pages |
| Font Family | Inter (body), Poppins (headings) | All pages |
| Dark Theme | #09090b background | All pages |
| Animations | fade-in, slide-in | All pages |

## Implementation Details

### Base Component
- **File:** `app/Livewire/BaseComponent.php`
- **Purpose:** Specifies unified layout for all authenticated Livewire components
- **Layout:** `components.layouts.app`

### Shared Layout
- **File:** `resources/views/components/layouts/app.blade.php`
- **Features:**
  - Sticky sidebar with mobile toggle
  - Responsive navbar
  - Consistent spacing and typography
  - Glass morphism effects
  - User profile dropdown

### Component Updates
All these components now extend `BaseComponent`:
- `app/Livewire/Categories/Index.php`
- `app/Livewire/Categories/Create.php`
- `app/Livewire/Categories/Edit.php`
- `app/Livewire/Expenses/Index.php`
- `app/Livewire/Expenses/Create.php`
- `app/Livewire/Expenses/Edit.php`

## Future Scalability

To add new pages with the unified sidebar:

1. Create a new Livewire component
2. Extend `BaseComponent` instead of `Component`
3. Create the view file
4. Add route to `routes/web.php`
5. Add navigation item to sidebar (if needed)

The layout will automatically be applied!
