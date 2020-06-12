#!/usr/bin/env python3

import csv

import numpy as np
from scipy import stats
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt

file = open("a.csv", "r")
file.readline()

csvReader = csv.reader(file)

studentID = []
sex = []
nationality = []
t1Result = []
t2Result = []
t3Result = []
t4Result = []
t12Result = []
t34Result = []


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


all4semester = [t1Result, t2Result, t3Result, t4Result]


def boxplot(data, labels):
    plt.boxplot(
        data, patch_artist=True, labels=labels,
    )
    plt.title("Average Result")
    plt.ylabel("Results")
    plt.show()


for item in csvReader:
    studentID.append(item[0])
    sex.append(item[1])
    nationality.append(item[2])
    t1Result.append(int(item[3]))
    t2Result.append(int(item[4]))
    t3Result.append(int(item[5]))
    t4Result.append(int(item[6]))
    sumR = int(item[3]) + int(item[4]) + int(item[5]) + int(item[6])
    t12Result.append(int(item[3]) + int(item[3]))
    t34Result.append(int(item[5]) + int(item[6]))

print("T1", stats.shapiro(t1Result))
print("T2", stats.shapiro(t2Result))
print("T3", stats.shapiro(t3Result))
print("T4", stats.shapiro(t4Result))
print(stats.kruskal(t1Result, t2Result, t3Result, t4Result))

print("t1 & t2", stats.kruskal(t1Result, t2Result))
print("t1 & t3", stats.kruskal(t1Result, t3Result))
print("t1 & t4", stats.kruskal(t1Result, t4Result))
print("t2 & t3", stats.kruskal(t2Result, t3Result))
print("t2 & t4", stats.kruskal(t2Result, t4Result))
print("t3 & t4", stats.kruskal(t3Result, t4Result))


print(
    "t1, t2, t3, t4  average:",
    np.mean(t1Result),
    np.mean(t2Result),
    np.mean(t3Result),
    np.mean(t4Result),
)

t12Result = np.array(t12Result) / 2
t34Result = np.array(t34Result) / 2
# boxplot([t12Result, t34Result], ["T1&T2 Result", "T3&T4 Result"])
# normality(t1Result, "T1 Result", "T1 Result normality")
# normality(t2Result, "T2 Result", "T2 Result normality")
# normality(t3Result, "T3 Result", "T3 Result normality")
# normality(t4Result, "T4 Result", "T4 Result normality")

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

# all4semester = [t1Result, t2Result, t3Result, t4Result]
# plt.boxplot(
#     all4semester,
#     patch_artist=True,
#     labels=["T1 Result", "T2 Result", "T3 Result", "T4 Result"],
# )
# # plt.xlabel("SEX")
# plt.title("Average Result")
# plt.ylabel("Results")
# plt.show()
