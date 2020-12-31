import React from "react";
import { shallow } from "enzyme";

import Banner from "./Banner";

test("Banner renders expected elements", () => {
  const banner = shallow(<Banner />);

  expect(
    banner.contains(
      <div className="banner">
        <img src="/images/Checkout51.png" alt="Checkout 51" className="logo" />
      </div>
    )
  ).toBe(true);
});
