import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import LocaleNavView from 'view/LocaleNavView';

window.addEventListener('load', () => {
  new LocaleNavView();
});
