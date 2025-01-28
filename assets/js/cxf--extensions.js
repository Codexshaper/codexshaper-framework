/**
 * ElementDependency - A JavaScript plugin for handling complex element interdependencies
 * Version 1.0.0
 */

class ElementDependency {
  constructor(options = {}) {
    this.options = {
      dependencyAttribute: "data-dependency",
      conditionAttribute: "data-condition",
      valueAttribute: "data-value",
      groupAttribute: "data-group",
      actionsAttribute: "data-actions",
      ...options,
    };

    this.dependencyMap = new Map();
    this.initialize();
  }

  initialize() {
    // Find all elements with dependencies
    const elements = document.querySelectorAll(
      `[${this.options.dependencyAttribute}]`
    );

    // Build dependency map
    elements.forEach((element) => {
      this.parseDependencies(element);
    });

    // Add event listeners
    this.attachEventListeners();
  }

  parseDependencies(element) {
    const dependencyStr = element.getAttribute(
      this.options.dependencyAttribute
    );
    const dependencies = dependencyStr.split(";").map((dep) => dep.trim());

    dependencies.forEach((dep) => {
      const [targetSelector, condition, value] = dep
        .split(":")
        .map((part) => part.trim());

      if (!this.dependencyMap.has(targetSelector)) {
        this.dependencyMap.set(targetSelector, []);
      }

      this.dependencyMap.get(targetSelector).push({
        element,
        condition,
        value,
        group: element.getAttribute(this.options.groupAttribute),
        actions: this.parseActions(
          element.getAttribute(this.options.actionsAttribute)
        ),
      });
    });
  }

  parseActions(actionsStr) {
    if (!actionsStr) return ["show"]; // Default action
    return actionsStr.split(",").map((action) => action.trim());
  }

  attachEventListeners() {
    this.dependencyMap.forEach((deps, selector) => {
      const targetElements = document.querySelectorAll(selector);

      targetElements.forEach((target) => {
        // Handle different types of elements
        if (target.tagName === "SELECT") {
          target.addEventListener("change", () =>
            this.evaluateDependencies(selector)
          );
        } else if (target.type === "checkbox" || target.type === "radio") {
          target.addEventListener("change", () =>
            this.evaluateDependencies(selector)
          );
        } else if (target.tagName === "INPUT") {
          target.addEventListener("input", () =>
            this.evaluateDependencies(selector)
          );
        }
      });
    });
  }

  evaluateDependencies(selector) {
    const dependencies = this.dependencyMap.get(selector);
    const targetElements = document.querySelectorAll(selector);

    dependencies.forEach((dep) => {
      const satisfied = this.checkCondition(
        targetElements,
        dep.condition,
        dep.value
      );
      this.applyActions(dep.element, satisfied, dep.actions);

      // Handle group dependencies
      if (dep.group) {
        this.handleGroupDependencies(dep.group, satisfied);
      }
    });
  }

  checkCondition(elements, condition, value) {
    const elementValues = Array.from(elements).map((el) => {
      if (el.type === "checkbox") return el.checked;
      if (el.type === "radio") return el.checked ? el.value : null;
      return el.value;
    });

    switch (condition) {
      case "equals":
        return elementValues.includes(value);
      case "notEquals":
        return !elementValues.includes(value);
      case "contains":
        return elementValues.some((val) => val.includes(value));
      case "empty":
        return elementValues.every((val) => !val);
      case "notEmpty":
        return elementValues.some((val) => val);
      case "checked":
        return elementValues.some((val) => val === true);
      case "unchecked":
        return elementValues.every((val) => val === false);
      case "greaterThan":
        return elementValues.some((val) => parseFloat(val) > parseFloat(value));
      case "lessThan":
        return elementValues.some((val) => parseFloat(val) < parseFloat(value));
      default:
        return false;
    }
  }

  applyActions(element, satisfied, actions) {
    actions.forEach((action) => {
      switch (action) {
        case "show":
          element.style.display = satisfied ? "" : "none";
          break;
        case "hide":
          element.style.display = satisfied ? "none" : "";
          break;
        case "enable":
          element.disabled = !satisfied;
          break;
        case "disable":
          element.disabled = satisfied;
          break;
        case "addClass":
          element.classList.toggle("dependent-active", satisfied);
          break;
        case "removeClass":
          element.classList.toggle("dependent-active", !satisfied);
          break;
      }
    });
  }

  handleGroupDependencies(group, satisfied) {
    const groupElements = document.querySelectorAll(
      `[${this.options.groupAttribute}="${group}"]`
    );
    groupElements.forEach((element) => {
      if (satisfied) {
        element.classList.add("group-active");
      } else {
        element.classList.remove("group-active");
      }
    });
  }

  // Public method to refresh dependencies
  refresh() {
    this.dependencyMap.clear();
    this.initialize();
  }

  // Public method to add new dependency
  addDependency(element, dependency) {
    element.setAttribute(this.options.dependencyAttribute, dependency);
    this.parseDependencies(element);
    this.attachEventListeners();
  }
}
