import React from "react";
import axios from "axios";
import MaterialTable from "material-table";

const Offers = () => {
  const [isLoading, setIsLoading] = React.useState(false);
  const [data, setData] = React.useState([]);

  React.useEffect(async () => {
    setIsLoading(true);
    try {
      const apiData = await axios("api/offers");
      const {
        data: { offers },
      } = apiData;
      const formattedOffers = offers.map((offer) => ({
        ...offer,
        image: <img src={offer.imageUrl} alt={offer.name} />,
      }));
      setData(formattedOffers);
    } catch (error) {
      console.log(error);
    }
    setIsLoading(false);
  }, []);

  const columns = [
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
  ];

  const options = {
    pageSize: 25,
    pageSizeOptions: [10, 25, 50, 100],
  };

  return (
    <div data-test-id="offers" className="offers">
      <MaterialTable
        title={
          <h6 className="title MuiTypography-root MuiTypography-h6">Offers</h6>
        }
        columns={columns}
        data={data}
        options={options}
        isLoading={isLoading}
      />
    </div>
  );
};

export default Offers;
