class TemplateController {
  constructor(containerId) {
    this.container = document.getElementById(containerId);
  }

  async loadTemplate(templatePath, data = {}) {
    try {
      const response = await fetch(templatePath);
      if (!response.ok) throw new Error(`Failed to load template: ${templatePath}`);
      let template = await response.text();

      // Inject data into the template
      template = this.replacePlaceholders(template, data);

      // Handle arrays (e.g., form options)
      template = this.replaceArrayPlaceholders(template, data);

      this.container.innerHTML = template;
    } catch (error) {
      console.error(error);
      this.container.innerHTML = `<p>Error loading template.</p>`;
    }
  }

  replacePlaceholders(template, data) {
    return template.replace(/{{\s*(\w+)\s*}}/g, (match, key) => data[key] || '');
  }

  replaceArrayPlaceholders(template, data) {
    return template.replace(/{{#(\w+)}}([\s\S]*?){{\/\1}}/g, (match, key, innerTemplate) => {
      if (!Array.isArray(data[key])) return '';
      return data[key]
        .map((item) => innerTemplate.replace(/{{\.}}/g, item))
        .join('');
    });
  }

  clearTemplate() {
    this.container.innerHTML = '';
  }
}

export default TemplateController;