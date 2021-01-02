import React from "react";
import { shallow, mount } from "enzyme";

import axios from "axios";
jest.mock("axios");

import MaterialTable from "material-table";
jest.mock("material-table", () => {
  const MaterialTable = () => <div />;
  return MaterialTable;
});

import Offers from "./Offers";

import { waitForComponentToPaint } from "../test-utils";

test("Offers renders expected components", async () => {
  const offer = {
    offerId: 40408,
    name: "Buy 2: Select TRISCUIT Crackers",
    imageUrl:
      "https://d3bx4ud3idzsqf.cloudfront.net/public/production/6840/67561_1535141624.jpg",
    cashBack: 1.0,
  };
  const response = {
    data: {
      batchId: 0,
      offers: [offer],
    },
  };
  axios.mockResolvedValue(response);

  const offers = mount(<Offers />);

  await waitForComponentToPaint(offers);

  const container = offers.find('[data-test-id="offers"]');
  expect(container.exists()).toBe(true);
  expect(container.hasClass("offers")).toBe(true);

  const table = container.find(MaterialTable);
  expect(table.exists()).toBe(true);

  const title = shallow(table.prop("title"));
  expect(
    title.matchesElement(
      <h6 className="title MuiTypography-root MuiTypography-h6">Offers</h6>
    )
  ).toBe(true);

  expect(table.prop("columns")).toEqual([
    { title: "ID", field: "offerId" },
    { title: "Name", field: "name" },
    { title: "Image", field: "image", sorting: false },
    {
      title: "Cash Back",
      field: "cashBack",
      type: "currency",
      currencySetting: {
        locale: "en-US",
        currencyCode: "USD",
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
      },
    },
  ]);

  expect(table.prop("data")).toEqual([
    {
      ...offer,
      image: <img src={offer.imageUrl} alt={offer.name} />,
    },
  ]);

  expect(table.prop("options")).toEqual({
    pageSize: 25,
    pageSizeOptions: [10, 25, 50, 100],
  });

  expect(table.prop("isLoading")).toBe(false);
});
