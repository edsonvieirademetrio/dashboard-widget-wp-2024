import React from "react";

import ReactDOM from "react-dom";

import { App } from "./App";

const containers = document.querySelectorAll(".cdw-widget-container");
if (containers.length > 0) {
  containers.forEach((container) => {
    ReactDOM.render(<App />, container);
  });
} else {
  console.log("No .cdw-widget-container elements found!");
}
