export default class UserFormView {
  /**
   * Constructor
   *
   * @param {string} target The selector of the root element
   */
  constructor(target) {
    this.root = document.querySelector(target);
    this.fileInput = this.root.querySelector('.input-avatar-file');
    this.inputNoAvatar = this.root.querySelector('.input-no-avatar');
    this.#initAvatarForm();
  }

  // *********************************************************
  // * Private functions
  // *********************************************************

  /**
   * Initialize avatar form
   */
  #initAvatarForm() {
    if (this.inputNoAvatar) {
      this.inputNoAvatar.addEventListener('change', (event) => {
        const isNoAvatar = event.currentTarget.checked;
        this.fileInput.disabled = isNoAvatar;
      });
    }
  }
}
