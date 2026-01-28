<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * Base Livewire Component with unified layout
 * 
 * All authenticated components should extend this class to ensure
 * consistent sidebar, navigation, and user profile placement across all pages.
 */
abstract class BaseComponent extends Component
{
    /**
     * Specify the layout for all components
     * This ensures a unified sidebar and navigation across Dashboard, Categories, and Expenses
     */
    protected string $layout = 'components.layouts.app';
}
