import React from "react";
import { shallow } from "enzyme";

import App from "./App";

test("App renders expected components", () => {
  const app = shallow(<App />);

  console.log(app.debug());
});
