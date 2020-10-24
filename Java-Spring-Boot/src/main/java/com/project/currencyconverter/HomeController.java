package com.project.currencyconverter;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.project.currencyconverter.service.CurrencyConverterService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import static org.springframework.web.bind.annotation.RequestMethod.POST;

@Controller
public class HomeController {

    @Autowired
    CurrencyConverterService currencyConverterService;

    @RequestMapping("")
    public String index(Model model) throws JsonProcessingException {
        model.addAttribute("currencyCodeList", currencyConverterService.getAvailableCurrencyCodes());
        return "currency-converter";
    }

    @RequestMapping(value = "", method = POST)
    public String currencyConversion(Model model, @RequestParam("amount") double amount, @RequestParam("fromCode") String fromCode, @RequestParam("toCode") String toCode) throws JsonProcessingException {
        model.addAttribute("currencyCodeList", currencyConverterService.getAvailableCurrencyCodes());
        model.addAttribute("action", "Y");
        model.addAttribute("convertedList", currencyConverterService.convertRates(amount, fromCode, toCode));
        return "currency-converter";
    }

}
