import React from "react";
import { shallow } from "enzyme";

import App from "./App";
import Banner from "./Banner";
import Offers from "./Offers";

test("App renders expected components", () => {
  const app = shallow(<App />);

  const banner = app.find(Banner);
  const offers = app.find(Offers);

  expect(banner.exists()).toBe(true);
  expect(offers.exists()).toBe(true);
});
