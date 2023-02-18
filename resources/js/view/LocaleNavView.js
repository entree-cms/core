export default class LocaleNavView {
  /**
   * Constructor
   */
  constructor() {
    this.localeInputs = document.querySelectorAll('.locale-nav [name="locale"]');
    if (this.localeInputs.length > 0) {
      this.setLocaleApiUrl = this.localeInputs[0].getAttribute('data-api-url');
      this.#initLocaleInputs();
    }
  }

  // *********************************************************
  // * Private functions
  // *********************************************************

  /**
   * Initialize locale inputs
   */
  #initLocaleInputs() {
    this.localeInputs.forEach((localeInput) => {
      localeInput.addEventListener('change', (event) => {
        const locale = localeInput.value;

        this.#setLocale(locale);
      });
    });
  }

  /**
   * Set locale
   *
   * @param {string} locale - The locale
   */
  #setLocale(locale) {
    const formData = new FormData();
    formData.append('locale', locale);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const options = {
      method: 'POST',
      headers: { 'X-CSRF-Token': csrfToken },
      body: formData,
    };


    fetch(this.setLocaleApiUrl, options).then((response) => {
      if (response.ok) {
        location.reload();
      } else {
        alert('Change failed. Please reload and try again.');
      }
    });
  }
}
