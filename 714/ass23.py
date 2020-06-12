#!/usr/bin/env python3

import csv

import numpy as np
from scipy import stats
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt


def boxplot(data, labels):
    plt.boxplot(
        data, patch_artist=True, labels=labels,
    )
    plt.title("Average Result By Nationality")
    plt.ylabel("Results")
    plt.show()
    # plt.xlabel("SEX")


def normfun(x, mu, sigma):
    pdf = np.exp(-((x - mu) ** 2) / (2 * sigma ** 2)) / (sigma * np.sqrt(2 * np.pi))
    return pdf


def normality(data, xlabel, title):
    data = np.array(data)
    data = np.sort(data)
    y = normfun(data, np.mean(data), np.std(data))
    print(data, y)

    # 参数,颜色，线宽
    plt.plot(data, y, color="y")

    # 数据，数组，颜色，颜色深浅，组宽，显示频率
    plt.hist(data, bins=10, normed=True)

    plt.title(title)
    plt.xlabel(xlabel)
    plt.ylabel("Probability")
    plt.show()

    # mu, sigma, num_bins = 0, 1, 50
    # # x = mu + sigma * data
    # # 正态分布的数据
    # n, bins, patches = plt.hist(
    #     data, num_bins, normed=True, facecolor="blue", alpha=0.5
    # )
    # # 拟合曲线
    # y = mlab.normpdf(bins, mu, sigma)
    # plt.plot(bins, y, "r--")
    # plt.xlabel(xlabel)
    # plt.ylabel("Probability")
    # plt.title(title)

    # plt.subplots_adjust(left=0.15)
    # plt.show()

    # mu, sigma = 60, 10
    # count, bins, ignored = plt.hist(data, 10, normed=True)
    # plt.plot(
    #     bins,
    #     1
    #     / (sigma * np.sqrt(2 * np.pi))
    #     * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
    #     linewidth=3,
    #     color="y",
    # )
    # plt.xlabel(xlabel)
    # plt.ylabel("Frequency")
    # plt.title(title)
    # plt.show()


def process(data):
    ave = []
    for i in data:
        ave.append(int(i[3]) + int(i[4]) + int(i[5]) + int(i[6]))
    print(ave)
    ave = list(map(lambda a: a / 4, ave))
    print(ave)
    return ave


file = open("a.csv", "r")
file.readline()

csvReader = csv.reader(file)

studentID = []
sex = []
nationality = []

data1 = []
data2 = []
data3 = []


for item in csvReader:
    if item[2] == "A":
        data1.append(item)
        print(item)
    elif item[2] == "B":
        data2.append(item)
        print(item)
    elif item[2] == "C":
        data3.append(item)
        print(item)

d1 = process(data1)
d2 = process(data2)
d3 = process(data3)


print()
print(d1)
print(np.mean(d1))
print()
print(d2)
print(np.mean(d2))
print()
print(d3)
print(np.mean(d3))
print()

print(stats.shapiro(d1))
print(stats.shapiro(d2))
print(stats.shapiro(d3))

print(d1)
print("AB", stats.f_oneway(d1, d2))
print("AC", stats.f_oneway(d1, d3))
print("BC", stats.f_oneway(d2, d3))

print("AB", stats.ttest_ind(d1, d2))
print("AC", stats.ttest_ind(d1, d3))
print("BC", stats.ttest_ind(d2, d3))

# boxplot([d1, d2, d3], ["A", "B", "C"])
# normality(d1, "Average Result", "Nationality A normality")
# normality(d2, "Average Result", "Nationality B normality")
# normality(d3, "Average Result", "Nationality C normality")


# print(stats.ttest_ind(maveResult, faveResult, equal_var=True))
# print(stats.levene(faveResult, maveResult))

print()
# print(
#     "Variance a={0:.3f}, Variance b={1:.3f}".format(
#         np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)
#     )
# )
# fstatistics = min(np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)) / max(
#     np.var(faveResult, ddof=1), np.var(maveResult, ddof=1)
# )  # because we estimate mean from data
# fdistribution = stats.f(
#     len(faveResult) - 1, len(maveResult) - 1
# )  # build an F-distribution object
# p_value = fdistribution.cdf(fstatistics)
# f_critical = fd.ppf(0.05)
# print(fstatistics, f_critical)
# if p_value < 0.05:
#     print("Reject H0", p_value)
# else:
#     print("Cant Reject H0", p_value)

# a = faveResult
# b = maveResult
# print(
#     "Variance a={0:.3f}, Variance b={1:.3f}".format(
#         np.var(a, ddof=1), np.var(b, ddof=1)
#     )
# )
# fstatistics = np.var(a, ddof=1) / np.var(
#     b, ddof=1
# )  # because we estimate mean from data
# fdistribution = stats.f(len(a) - 1, len(b) - 1)  # build an F-distribution object
# p_value = 2 * min(fdistribution.cdf(f_critical), 1 - fdistribution.cdf(f_critical))
# f_critical1 = fdistribution.ppf(0.025)
# f_critical2 = fdistribution.ppf(0.975)
# print(fstatistics, f_critical1, f_critical2)
# if p_value < 0.05:
#     print("Reject H0", p_value)
# else:
#     print("Cant Reject H0", p_value)

# F = np.var(a) / np.var(b)
# df1 = len(a) - 1
# df2 = len(b) - 1
# p_value = 1 - 2 * abs(0.5 - stats.f.cdf(F, df1, df2))
# print("var(female):", np.var(a), "var(male)", np.var(b))
# print("F:", F, "p_value", p_value)

# print(stats.ttest_rel(faveResult, maveResult))

# mu, sigma = 50, 10
# count, bins, ignored = plt.hist(t12Result, 10)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("T1&T2 Results")
# plt.ylabel("Frequency")
# plt.title("T1&T2 Result Normality")
# plt.show()

# mu, sigma = 50, 10
# count, bins, ignored = plt.hist(t34Result, 10)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("T3&T4 Results")
# plt.ylabel("Frequency")
# plt.title("T3&T4 Result Normality")
# plt.show()

# mu, sigma = 70, 10
# count, bins, ignored = plt.hist(t3Result, 10)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("T3 Results")
# plt.ylabel("Frequency")
# plt.title("T3 Result Normality")
# plt.show()

# mu, sigma = 90, 10
# count, bins, ignored = plt.hist(t4Result, 10)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("T4 Results")
# plt.ylabel("Frequency")
# plt.title("T4 Result Normality")
# plt.show()
