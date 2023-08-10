import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

// Importa mode-dark.js
import './mode-dark';
// Importa mode-sideBar.js
import './mode-sideBar';

window.Alpine = Alpine;

Alpine.plugin(focus);
import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.css'

Alpine.start();

if (import.meta.hot)
    import.meta.hot.accept(() => import.meta.hot.invalidate())

