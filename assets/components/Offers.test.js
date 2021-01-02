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

  expect(
    offers.contains(
      <div className="offers">
        <MaterialTable
          title="Offers"
          columns={[
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
          ]}
          data={[
            {
              ...offer,
              image: <img src={offer.imageUrl} alt={offer.name} />,
            },
          ]}
          options={{
            pageSize: 25,
            pageSizeOptions: [10, 25, 50, 100],
          }}
          isLoading={false}
        />
      </div>
    )
  ).toBe(true);
});
